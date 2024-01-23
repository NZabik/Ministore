<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control rounded-0',
                    'placeholder' => 'Search a product'
                ]
            ])
            // ->add('search', SubmitType::class, [
            //     'attr' => [
            //         'class' => 'btn btn-black text-uppercase btn-rounded-none',
            //     ]
            // ])
            ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }


/**
     * @Route("/handleSearch", name="handleSearch")
     * @param Request $request
     */
    #[Route('/handleSearch', name: 'handleSearch')]
    public function handleSearch(Request $request, ItemRepository $item)
    {
        $query = $request->request->all('form')['query'];
        if($query) {
            $items = $item->findArticlesByName($query);
        }
        return $this->render('search/index.html.twig', [
            'items' => $items
        ]);
    }

}
