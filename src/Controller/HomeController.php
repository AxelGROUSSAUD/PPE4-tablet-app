<?php


namespace App\Controller;

use App\Repository\PartieRepository;
use App\Entity\Partie;
use App\Entity\PhotoClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PublishType;

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
        $publication = new PhotoClient();
        $form = $this->createForm(PublishType::class,$publication, $partie);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $picture = $form->get('file')->getData();
            if($picture){
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            }
        }
        return $this->render('home/publish.html.twig', [
            
            'form' => $form->createView(),
        ]);
    }
}