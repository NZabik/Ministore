<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Form\AddressType;
use App\Entity\OrdersDetails;
use App\Form\OrderValidationType;
use App\Repository\ItemRepository;
use App\Repository\UserRepository;
use App\Repository\OrdersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/orders', name: 'app_orders_')]
class OrdersController extends AbstractController
{
    #[Route('/add', name: 'add')]
    #[IsGranted('ROLE_USER')]
    public function add(SessionInterface $session, ItemRepository $itemRepository, EntityManagerInterface $em, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $panier = $session->get('panier', []);
        // Si le panier est vide, retour sur le shop
        if ($panier === []) {
            $this->addFlash('error', 'Your cart is empty');
            return $this->redirectToRoute('app_item_index');
        }
        // Si le panier n'est pas vide, on crée la commande
        $order = new Orders();

        // on rempli la commande
        $order->setUser($this->getUser());
        // Parcours du panier pour créer les détails de la commande
        foreach ($panier as $item => $quantity) {
            $orderDetails = new OrdersDetails();
            //recherche produit
            $product = $itemRepository->find($item);
            $price = $product->getPrice();

            //création des détails de la commande
            $orderDetails->setItem($product);
            $orderDetails->setPrice($price);
            $orderDetails->setQuantity($quantity);
            $order->addOrdersDetail($orderDetails);
        }
        // Adresses par défaut dans le compte client.
        $user = $this->getUser();
        assert($user instanceof User);
        $userAdresse = $user->getAdresse();
        $userCP = $user->getCodePostal();
        $userVille = $user->getVille();
        $favAdresse = $user->getFavAdresse();
        $favCP = $user->getFavCodePostal();
        $favVille = $user->getFavVille();
        // soumission du formulaire de demande de confirmation de l'adresse de livraison
        $form = $this->createForm(AddressType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->request->has('save')) {
            // ajout de l'adresse de livraison depuis le formulaire et passer à la validation
            $order->setAdresse($form->get('adresse')->getData());
            $order->setCodePostal($form->get('codePostal')->getData());
            $order->setVille($form->get('ville')->getData());

            $session->set('order', $order);
            $this->addFlash('success', 'Address confirmed successfully');
            return $this->redirectToRoute('app_orders_validate');
            } elseif ($request->request->has('save_as_favorite')) {
                $user = $this->getUser();
                assert($user instanceof User);
                // Enregistrer l'adresse comme favorite et passer à la validation
                $user->setFavAdresse($form->get('adresse')->getData());
                $user->setFavCodePostal($form->get('codePostal')->getData());
                $user->setFavVille($form->get('ville')->getData());
                $em->persist($user);
                $em->flush();
                $order->setAdresse($form->get('adresse')->getData());
                $order->setCodePostal($form->get('codePostal')->getData());
                $order->setVille($form->get('ville')->getData());
    
                $session->set('order', $order);
                $this->addFlash('success', 'Address confirmed successfully');
                return $this->redirectToRoute('app_orders_validate');
            }
            
        }

        return $this->render('orders/add.html.twig', [
            'form' => $form->createView(),
            'favAdresse' => $favAdresse,
            'favCP' => $favCP,
            'favVille' => $favVille,
            'userAdresse' => $userAdresse,
            'userCP' => $userCP,
            'userVille' => $userVille,
        ]);
    }
    // affichage de la commande avec le formulaire de validation finale
    #[Route('/validate', name: 'validate')]
    #[IsGranted('ROLE_USER')]
    public function validate(Request $request, ItemRepository $itemRepository, EntityManagerInterface $em, SessionInterface $session): Response
    {
        // récupération de la commande en session
        $order = $session->get('order');
        // réatribution du user pour ne pas avoir un problème de persist double (seul moyen trouvé pour ça)
        $order->setUser($this->getUser());
        // récupération du panier en session
        $panier = $session->get('panier', []);
        // suppression des détails de la commande car sinon, problème de persist double
        foreach ($order->getOrdersDetails() as $orderDetails) {
            $order->removeOrdersDetail($orderDetails);
        }
        // Parcours du panier pour recréer les détails de la commande après avoir été supprimées à cause du persist double
        foreach ($panier as $item => $quantity) {
            $orderDetails = new OrdersDetails();
            //recherche produit
            $product = $itemRepository->find($item);
            $price = $product->getPrice();

            // Diminuer la quantité de l'item
            $product->setQuantity($product->getQuantity() - $quantity);
            $em->persist($product);

            //création des détails de la commande
            $orderDetails->setItem($product);
            $orderDetails->setPrice($price);
            $orderDetails->setQuantity($quantity);
            $order->addOrdersDetail($orderDetails);
        }
        // création du formulaire de validation finale
        $form = $this->createForm(OrderValidationType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order->setReference(uniqid('order_'));
            //on persist et on flush 
            $em->persist($order);
            $em->flush();
            //on vide le panier
            $session->remove('panier');
            $session->remove('order');
            $this->addFlash('success', 'Order passed successfully');
            // on retourne sur la liste des commandes du client
            return $this->redirectToRoute('app_orders_show');
        }
        return $this->render('orders/validate.html.twig', [
            'form' => $form->createView(),
            'order' => $order
        ]);
    }
    #[Route('/delete', name: 'delete')]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, ItemRepository $itemRepository, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $session->remove('panier');
        $session->remove('order');
        $this->addFlash('success', 'Order removed successfully');
        // on redirige vers le panier
        return $this->redirectToRoute('app_item_index');
    }

    #[Route('/', name: 'show')]
    #[IsGranted('ROLE_USER')]
    public function show(): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);
        return $this->render('orders/index.html.twig', [
            'orders' => $user->getOrders(),
            'user' => $user
        ]);
    }
    #[Route('/admin/orders', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function orders(OrdersRepository $orders, UserRepository $user): Response
    {
        $orders = $orders->findAll();
        $users = $user->findAll();
        return $this->render('admin/orders.html.twig', [
            'orders' => $orders,
            'users' => $users
            
        ]);
    }
}
