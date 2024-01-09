<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Form\AddressType;
use App\Entity\OrdersDetails;
use App\Form\OrderValidationType;
use App\Repository\ItemRepository;
use App\Repository\OrdersRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/orders', name: 'app_orders_')]
class OrdersController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(SessionInterface $session, ItemRepository $itemRepository, EntityManagerInterface $em, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $panier = $session->get('panier', []);
        // Si le panier est vide, retour sur le shop
        if ($panier === []) {
            $this->addFlash('message', 'Your cart is empty');
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
        // Adresses par défaut dans le compte client
        $userAdresse = $this->getUser()->getAdresse();
        $userCP = $this->getUser()->getCodePostal();
        $userVille = $this->getUser()->getVille();
        // soumission du formulaire de demande de confirmation de l'adresse de livraison
        $form = $this->createForm(AddressType::class, ['adresse' => $userAdresse, 'codePostal' => $userCP, 'ville' => $userVille]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // ajout de l'adresse de livraison depuis le formulaire 
            $order->setAdresse($form->get('adresse')->getData());
            $order->setCodePostal($form->get('codePostal')->getData());
            $order->setVille($form->get('ville')->getData());
            
            $session->set('order', $order);
            return $this->redirectToRoute('app_orders_validate');
        }

        return $this->render('orders/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    // affichage de la commande avec le formulaire de validation finale
    #[Route('/validate', name: 'validate')]
    public function validate(Request $request, ItemRepository $itemRepository, EntityManagerInterface $em, SessionInterface $session): Response
    {
        // récupération de la commande en session
        $order = $session->get('order');
        // réatribution du user pour ne pas avoir un problème de persist double (seul moyen trouvé pour ça)
        $order->setUser($this->getUser());
        // récupération du panier en session
        $panier = $session->get('panier', []);
        // suppression des détails de la commande car sinon, problème de persist double
        foreach($order->getOrdersDetails() as $orderDetails){
            $order->removeOrdersDetail($orderDetails);
        }
        // Parcours du panier pour recréer les détails de la commande après avoir été supprimées à cause du persist double
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

            $this->addFlash('message', 'Order passed successfully');
            // on retourne sur la liste des commandes du client
            return $this->redirectToRoute('app_orders_show');
        
        }
        return $this->render('orders/validate.html.twig', [
            'form' => $form->createView(),
            'order' => $order
        ]);
    }
    #[Route('/', name: 'show')]
    public function show(): Response
    {
        $user = $this->getUser();
        assert($user instanceof User);
        return $this->render('orders/index.html.twig', [
            'orders' => $user->getOrders()
        ]);
    }
}
