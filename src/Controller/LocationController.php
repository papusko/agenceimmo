<?php

namespace App\Controller;


use App\Entity\Location;
use App\Entity\Locataire;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    /**
     * @var LocationRepository
     */
	private $Repository;

	public function __construct(LocationRepository $repository)
	{
		$this->repository=$repository;
		
	}	


	/**
     * @Route("/location", name="location")
     */
    public function index()
    {
        $location=$this->repository->findAll();
        return $this->render('location/index.html.twig', [
            'location' => $location,
        ]);
    }


    /**
     * @Route("/location/creer", name="location.creer")
     */
    public function creer(Request $request)
    {
           $location = new Location();

       $form =  $this->createForm(LocationType::class, $location);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $location = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($location);
         $entityManager->flush();

        return $this->redirectToRoute('location');
        }

        return $this->render('location/creer.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


     /**
     * @Route("/location/modifier/{id}", name="location.modifier.admin", methods="GET|POST")
     */
    public function modification(Request $request, Location $location)
    {
       
       $form =$this->createForm(LocationType::class, $location);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $location = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         //$entityManager->persist($mobilier);
         $entityManager->flush();
         $this->addFlash('success', 'Informationdu location modifier avec succès');            

        return $this->redirectToRoute('location');
        }

        return $this->render('location/modifier.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


           /**
     * @Route("/location/suprimer/{id}", name="location.delete")
     */
       public function supprimer(Location $location)
       {
           $em= $this->getDoctrine()->getManager();
           $em->remove($location);
           $em->flush();
           return $this->redirectToRoute('location');

       }
}
