<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Lignedecommande;
use App\Repository\CategoriesRepository;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande/{id}", name="commande")
     */
    public function index($id, CategoriesRepository $catRepo, CommandeRepository $commandeRepo): Response
    {
        return $this->render('commande/index.html.twig', [
            'categories' => $catRepo->findAll(),
            'Commande' => $commandeRepo->findBy(['user'=>$id]),
        ]);
    }


    /**
    * @Route("/commande/save/{id}", name="commande_save")
    */
    public function saveCommande($id, SessionInterface $session, EntityManagerInterface $entityManager, Request $request, ProduitRepository $proRepo, CategoriesRepository $catRepo, CommandeRepository $commandeRepo): Response
    {
        // On récupére le contenu du panier dans un tableau vide [] et on l'attribue à la variable $panier
        $panier = $session->get("panier", []);

        $montantTotal=0;
        foreach($panier as $key=>$value)
        {
            $montantTotal=$montantTotal+$value['montant'];
        }
       
        $commande = new Commande;
        $commande->setComDate(new \DateTime());
        $commande->setComMontant($montantTotal);
        $commande->setDateFacturation(new \DateTime());

        $modePayment = $request->get("payment");        
        $commande->setModePaiement($modePayment);
    
        $commande->setUser($this->getUser());

        $entityManager->persist($commande);
        $entityManager->flush($commande);

        foreach($panier as $key=>$value)
        {
            $lignedecommande = new Lignedecommande;
            $lignedecommande->setCom($commande);    
            $produit = $proRepo->find($value['id']);
            $lignedecommande->setPro($produit);
            $lignedecommande->setQuantite($value['quantite']);
            
            $entityManager->persist($lignedecommande);
            $entityManager->flush($lignedecommande);
        } 

        // On vide le contenu du panier
        $panier = $session->set("panier", []);

        return $this->render('commande/index.html.twig', [
            'categories' => $catRepo->findAll(),
            'Commande' => $commandeRepo->findBy(['user' => $id]),
        ]);

        // return $this->redirectToRoute('commande', ['id' => $this->getUser()]);
    }
}
