<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Category;
use Doctrine\ORM\QueryBuilder;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltreController extends AbstractController
{
    #[Route('/filtre', name: 'app_filtre')]
    public function index(): Response
    {
        return $this->render('filtre/index.html.twig', [
            'controller_name' => 'FiltreController',
        ]);
    }
        
    public function filterBarAll()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('filterSearchAll'))
            ->add('item', EntityType::class, [
                'class' => Item::class,
                'required' => false,
                'label' => 'Article',
                'placeholder' => '',
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'rounded-0'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'required' => false,
                'label' => 'Category',
                'placeholder' => '',
                'choice_label' => 'type',
                'attr' => [
                    'class' => 'rounded-0'
                ]
            ])
            ->add('filter', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-black text-uppercase btn-rounded-none mb-2'
                ]
            ])
            ->getForm();
        return $this->render('filtre/filterBarAll.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/filterSearchAll', name: 'filterSearchAll')]
    public function filterSearchAll(Request $request, ItemRepository $item)
    {
        $query = $request->request->all('form')['item'];
        $query2 = $request->request->all('form')['category'];
        if  (($query == "") && ($query2 == "")){
            return $this->redirectToRoute( 'app_item_index' )
        ;
        } else if ($query or $query2) {
            $items = $item->findArticlesByAll($query , $query2);
        }
        return $this->render('filtre/index.html.twig', [
            'items' => $items
        ]);
    }
}
