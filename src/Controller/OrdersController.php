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
        
        
        $userAdresse = $this->getUser()->getAdresse();
        $userCP = $this->getUser()->getCodePostal();
        $userVille = $this->getUser()->getVille();
        // Gérer la soumission du formulaire de demande d'adresse
        $form = $this->createForm(AddressType::class, ['adresse' => $userAdresse, 'codePostal' => $userCP, 'ville' => $userVille, $order]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
             // ajout de l'adresse complète à la commande depuis le formulaire 
            $order->setAdresse($form->get('adresse')->getData());
            $order->setCodePostal($form->get('codePostal')->getData());
            $order->setVille($form->get('ville')->getData());
            $order->setReference(uniqid('order_'));
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
            // ajout du formulaire de validation de la commande
            // $form2 = $this->createForm(OrderValidationType::class, $order);
            // $form2->handleRequest($request);
            // if ($form2->isSubmitted() && $form2->isValid()) {
            //     $order->setReference(uniqid('order_'));
            //     //on persist et on flush 
            //     $em->persist($order);
            //     $em->flush();
            //     //on vide le panier
            //     $session->remove('panier');

            //     $this->addFlash('message', 'Order passed successfully');
                
            //     return $this->redirectToRoute('app_orders_show');
            
            // }
            // return $this->render('orders/validate.html.twig', [
            //     'form2' => $form2->createView(),
            //     'order' => $order
            // ]);
            // on persist et on flush 
                $em->persist($order);
                $em->flush();
                //on vide le panier
                $session->remove('panier');

                $this->addFlash('message', 'Order passed successfully');
                
                return $this->redirectToRoute('app_orders_show');
        }

        
        return $this->render('orders/add.html.twig', [
            'form' => $form->createView(),
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
