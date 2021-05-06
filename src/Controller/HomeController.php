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
        $photoClient = new PhotoClient();
        $form = $this->createForm(PhotoClientType::class, $photoClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($photoClient);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('photo_client/new.html.twig', [
            'photo_client' => $photoClient,
            'form' => $form->createView(),
        ]);
    }
}