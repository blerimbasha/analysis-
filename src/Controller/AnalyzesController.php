<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnalyzesController extends AbstractController
{
    /**
     * @Route("/analyzes", name="analyzes")
     */
    public function index()
    {
    	$number = 2;
        return $this->render('analyzes/epa.html.twig', [
        	'number' => $number,
        ]);

    }
    
}
