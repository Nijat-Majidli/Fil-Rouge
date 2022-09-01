<?php

namespace App\Controller;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }


    /**
    * @Route("/commande/save", name="commande_save")
    */
    public function enregistrer(SessionInterface $session, EntityManagerInterface $entityManager, Request $request): Response
    {
        // On récupére le contenu du panier dans un tableau vide [] et on l'attribue à la variable $panier
        $panier = $session->get("panier", []);
       
        $montantTotal=0;
        foreach($panier as $key=>$value)
        {
            $montantTotal=$montantTotal+$value['montant'];
        }

        dd($request->get("payment"));
       
        $commande=new Commande;
        $commande->setComDate(new \DateTime());
        $commande->setComMontant($montantTotal);
        $commande->setDateFacturation(new \DateTime());

        $modePayment = $request->get("payment");        
        $commande->setModePaiement($modePayment);

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
}
