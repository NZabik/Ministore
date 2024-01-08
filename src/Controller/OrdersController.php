<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Form\AddressType;
use App\Entity\OrdersDetails;
use App\Repository\ItemRepository;
use App\Repository\OrdersRepository;
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
        $order->setReference(uniqid('order_'));
        // $order->setAdresse($this->getUser()->getAdresse());
        // $order->setCodePostal($this->getUser()->getCodePostal());
        // $order->setVille($this->getUser()->getVille());
        $form = $this->createForm(AddressType::class, $order);

        // Gérez la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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
            //on persist et on flush    
            $em->persist($order);
            $em->flush();

            //on vide le panier
            $session->remove('panier');

            $this->addFlash('message', 'Order passed successfully');

            return $this->redirectToRoute('app_item_index');
        }

        // Renvoyez le formulaire à la vue
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
