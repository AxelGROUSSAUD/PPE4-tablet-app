<?php


namespace App\Controller;

use App\Repository\PartieRepository;
use App\Entity\Partie;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/{id}", name="publication", methods={"GET","POST"})
     */
    public function publish(Request $request, Partie $partie): Response
    {
        $form = $this->createForm(PublishType::class);
        $form->handleRequest($request);
        return $this->render('home/publish.html.twig', [
            
            'form' => $form->createView(),
        ]);
    }
}