<?php


namespace App\Controller;

use App\Repository\PartieRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PartieRepository $partierepository): Response
    {
        $day = date_create('now');
        $Today =  $partierepository->getByDate($day);



        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            //'parties' => $allparty,
            'today' =>$Today
        ]);
    }
}