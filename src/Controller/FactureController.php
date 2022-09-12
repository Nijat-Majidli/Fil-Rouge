<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\LignedecommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


class FactureController extends AbstractController
{
    /**
     * @Route("/facture/{id}", name="facture")
     */
    public function index($id, CommandeRepository $commandeRepo, LignedecommandeRepository $lignedecommandeRepo)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set([
            'defaultFont'=>'Arial', 
            'isRemoteEnabled'=>true, 
            'isPhpEnabled'=>true, 
            'chroot'=>"images/facture/VillageGreen.jpg"
        ]);
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('facture/index.html.twig', [
            'Commande' => $commandeRepo->find($id),
            'Produit' => $lignedecommandeRepo->findBy(['com'=>$id])
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'landscape'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("facture.pdf", ["Attachment" => true,]);
    }
}
