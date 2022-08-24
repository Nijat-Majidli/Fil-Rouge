<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(CategoriesRepository $catRepo): Response
    {
        return $this->render('home/index.html.twig', [
            'categories' => $catRepo->findAll()
            ]);
    }  

}
