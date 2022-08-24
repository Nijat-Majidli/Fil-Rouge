<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="categories_index", methods={"GET"})
     */
    public function index(CategoriesRepository $catRepo): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $catRepo->findAll(),
        ]);
    }

    /**
    * @Route("/{id}", name="categories_show", methods={"GET"})
    */
    public function show(Categories $category): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $category,
        ]);
    }

    /**
     * @Route("/new", name="categories_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);
        
        // récupération de l'id de catégorie
        $idCategory = $category->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            // récupération de la saisi sur l'upload
            $photo = $form['cat_photo']->getData();
            // vérification s'il y a un upload photo
            if ($photo) {
                // renommage de photo: nom de photo + extension
                $newPhoto = $idCategory . '.' . $photo->guessExtension();
                // assignation de la valeur à la propriété "cat_photo" à l'aide du setter
                $category->setCatPhoto($newPhoto);
                try {
                    // déplacement de photo vers le répertoire de destination sur le serveur
                    $photo->move(
                        $this->getParameter('photo_directory'),
                        $newPhoto
                    );
                } catch (FileException $e) {
                    // gestion de l'erreur si le déplacement ne s'est pas effectué
                }
            }
               
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Catégorie ajouté avec succès !!'
            );
            
            return $this->redirectToRoute('categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="categories_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categories_delete", methods={"POST"})
     */
    public function delete(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
