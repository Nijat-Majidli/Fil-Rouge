<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\LignedecommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


class FactureController extends AbstractController
{
    /**
     * @Route("/facture/{id}", name="facture")
     */
    public function index(Knp\Snappy\Pdf $knpSnappyPdf, $id, CommandeRepository $commandeRepo, LignedecommandeRepository $lignedecommandeRepo)
    {
        $html = $this->renderView('facture/index.html.twig', [
            'Commande' => $commandeRepo->find($id),
            'Produit' => $lignedecommandeRepo->findBy(['com'=>$id])
        ]);

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }


    // Include Dompdf required namespaces
    // use Dompdf\Dompdf;
    // use Dompdf\Options;

    /**
     * @Route("/facture/{id}", name="facture")
     */
    // public function index($id, CommandeRepository $commandeRepo, LignedecommandeRepository $lignedecommandeRepo)
    // {
    //     // Configure Dompdf according to your needs
    //     $pdfOptions = new Options();
    //     $pdfOptions->setIsRemoteEnabled(true);
    //     $pdfOptions->set(['defaultFont'=>'Arial', 'isHtml5ParserEnabled'=>true, 'isRemoteEnabled'=>true, 'isPhpEnabled'=>true]);
        
    //     // Instantiate Dompdf with our options
    //     $dompdf = new Dompdf($pdfOptions);

    //     // Retrieve the HTML generated in our twig file
    //     $html = $this->renderView('facture/index.html.twig', [
    //         'Commande' => $commandeRepo->find($id),
    //         'Produit' => $lignedecommandeRepo->findBy(['com'=>$id])
    //     ]);
        
    //     // Load HTML to Dompdf
    //     $dompdf->loadHtml($html);
        
    //     // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
    //     $dompdf->setPaper('A4', 'portrait');

    //     // Render the HTML as PDF
    //     $dompdf->render();

    //     // Output the generated PDF to Browser (force download)
    //     $dompdf->stream("facture.pdf", [
    //         "Attachment" => true
    //     ]);
    // }
}
