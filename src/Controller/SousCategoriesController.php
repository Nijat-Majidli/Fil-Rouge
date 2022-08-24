<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SouscategoriesRepository;
use App\Repository\CategoriesRepository;

class SousCategoriesController extends AbstractController
{
    /**
     * @Route("/sous/categories/{id}", name="sous_categories")
     */
    public function index($id, CategoriesRepository $catRepo, SouscategoriesRepository $sousCatRepo): Response
    {
        return $this->render('sous_categories/index.html.twig', [
            'categories' => $catRepo->findAll(),
            'Categorie' => $catRepo->find($id),
            'SousCategories' => $sousCatRepo->findBy(['cat'=>$id])
        ]);
    }
}


