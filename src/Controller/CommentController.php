<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\User;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="app_comment")
     */
    public function index(): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    /**
     * @Route("/addcomment/{userId}/{produitId}", name="add_comment")
     */
    public function addComment(User $userId, $produitId, ProduitRepository $proRepo, Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit =  $proRepo->find($produitId);

        // On récupére le contenu du commentaire en utilisant l'attribut name="comments" de la balise <textarea> dans la vue "detail.hml.twig"
        $content = $request->get("comments");

        $comment = new Comments;
        $comment->setUser($userId);
        $comment->setProduit($produit);
        $comment->setContent($content);
        $comment->setDate(new \DateTime());

        $entityManager->persist($comment);
        $entityManager->flush($comment);

        return $this->redirectToRoute('detail', ['id' => $produitId]);
    }
}
