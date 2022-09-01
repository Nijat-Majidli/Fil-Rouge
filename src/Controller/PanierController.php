<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{  
    /**
     * @Route("/panier", name="panier")
    */
    public function index(SessionInterface $session, CategoriesRepository $catRepo): Response
    {
        // On récupére le contenu du panier dans un tableau vide [] et on l'attribue à la variable $panier
        $panier = $session->get("panier", []);

        return $this->render('panier/index.html.twig', [
            'categories' => $catRepo->findAll(),
            'panier' => $panier,
        ]);     
    }


    /**
     * @Route("/addPanier/{id}", name="addPanier")
    */
    public function addPanier($id, SessionInterface $session, ProduitRepository $proRepo, Request $request, CategoriesRepository $catRepo): Response
    {
        // On récupére le contenu du panier et on le met dans un tableau vide
        $panier = $session->get("panier", []);
        
        if(($request->get("quantity")))
        {
            $quantite = $request->get("quantity");
        }
        else{
            $quantite=1;
        }

        $produit = $proRepo->find($id);
        $produitStock = $produit->getProStock();
        
        $messageStock = "";

        if(empty($panier))
        {
            $panier[] = [
                "id" => $produit->getId(),
                "photo" => $produit->getProPhoto(),
                "libelle" => $produit->getProLibelle(),
                "prix" => $produit->getPrixTTC(),
                "quantite" => $quantite
            ];
        }
        else
        {
            $produitsId = [];

            foreach($panier as $prod)
            {
                array_push($produitsId, $prod['id']);
            }

            if (!in_array($id, $produitsId))
            {
                $panier[] = [
                    "id" => $produit->getId(),
                    "photo" => $produit->getProPhoto(),
                    "libelle" => $produit->getProLibelle(),
                    "prix" => $produit->getPrixTTC(),
                    "quantite" => $quantite
                ];
            }
            else
            {
                foreach($panier as $key=>$value)
                {
                    if($value['id']==$id)
                    {
                        if(($value['quantite'] + $quantite) <= $produitStock)
                        {
                            $panier[$key]['quantite'] = $value['quantite'] + $quantite;
                        }
                        else 
                        {
                            $panier[$key]['quantite'] = $produitStock;
                            $messageStock="Le stock actuel disponible est ".$produitStock." ".$produit->getProLibelle();
                        }
                    }
                }
            }
        }

        $session->set("panier", $panier);

        return $this->render('panier/index.html.twig', [
            'categories' => $catRepo->findAll(),
            'panier' => $panier,
            'messageStock' => $messageStock
        ]);     
    }


    /**
     * @Route("/removePanier/{id}", name="removePanier")
     */
    public function removePanier($id, SessionInterface $session, CategoriesRepository $catRepo): Response
    {
        $panier = $session->get("panier", []);

        foreach($panier as $key => $value)
        {
            if($value['id']==$id)
            {
                if($value['quantite'] > 1)
                {
                    $panier[$key]['quantite']--;
                }
                else
                {
                    unset($panier[$key]);
                }
            }
        }
        
        $session->set("panier", $panier);

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'categories' => $catRepo->findAll()
        ]);
    }


    /**
     * @Route("/deletePanier/{id}", name="deletePanier")
     */
    public function deletePanier($id, SessionInterface $session, CategoriesRepository $catRepo): Response
    {
        $panier = $session->get("panier", []);

        foreach($panier as $key => $value)
        {
            if($value['id']==$id)
            {
                unset($panier[$key]);
            }     
        }
        
        $session->set("panier", $panier);

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'categories' => $catRepo->findAll()
        ]);
    }


    /**
     * @Route("/deleteAllPanier", name="delete_allPanier")
     */
    public function deleteAllPanier(SessionInterface $session, CategoriesRepository $catRepo): Response
    {
        $panier = $session->set("panier", []);

        //  On peut aussi vider le panier comme ça:   $panier = $session->remove("panier");

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'categories' => $catRepo->findAll()
        ]);
    }


    /**
     * @Route("/profile/payPanier", name="payPanier")
    */
   public function payPanier(SessionInterface $session, ProduitRepository $prodRepo, CategoriesRepository $catRepo): Response
   {
       // On récupére le contenu du panier dans un tableau vide [] et on l'attribue à la variable $panier
       $panier = $session->get("panier", []);

        foreach($panier as $key=>$value)
        {
            $produit = $prodRepo->find($value['id']);
            $description = $produit->getProDescription();
            $panier[$key]['description']= $description;

            $montant = $value['quantite'] * $value['prix'];
            $panier[$key]['montant']= $montant;
        }
        
        $session->set("panier", $panier);

        return $this->render('panier/paypanier.html.twig', [
            'categories' => $catRepo->findAll(),
            'panier' => $panier,
        ]);     
    }







}