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
    public function index($id, CategoriesRepository $catRepo, ProduitRepository $pro, SouscategoriesRepository $SousCateg): Response
    {
        return $this->render('produit/index.html.twig', [
            'categories' => $catRepo->findAll(),
            'Produits' => $pro->findBy(['sousCat'=>$id]),
            'SousCategorie' => $SousCateg->find($id)
        ]);
    }


    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detail($id, ProduitRepository $pro, CategoriesRepository $catRepo): Response
    {
        return $this->render('produit/detail.html.twig', [
            'categories' => $catRepo->findAll(),
            'Detail' => $pro->find($id)
        ]);
    }
}


