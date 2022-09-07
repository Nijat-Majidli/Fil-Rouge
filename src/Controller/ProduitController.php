<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitRepository;
use App\Repository\SouscategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/{id}", name="produit")
     */
    public function index($id, CategoriesRepository $catRepo, ProduitRepository $proRepo, SouscategoriesRepository $SousCatRepo): Response
    {
        return $this->render('produit/index.html.twig', [
            'categories' => $catRepo->findAll(),
            'Produits' => $proRepo->findBy(['sousCat'=>$id]),
            'SousCategorie' => $SousCatRepo->find($id)
        ]);
    }


    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detail($id, ProduitRepository $proRepo, CategoriesRepository $catRepo): Response
    {    
        return $this->render('produit/detail.html.twig', [
            'categories' => $catRepo->findAll(),
            'Detail' => $proRepo->find($id),
        ]);
    }
}


