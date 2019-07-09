<?php

namespace App\Controller;

use App\Entity\Locataire;
use App\Form\LocataireType;
use App\Repository\LocataireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LocataireController extends AbstractController
{
	/**
     * @var LocataireRepository
     */
	private $Repository;

	public function __construct(LocataireRepository $repository)
	{
		$this->repository=$repository;
		
	}	


	/**
     * @Route("/locataire", name="locataire")
     */
    public function index()
    {
        $locataire=$this->repository->findAll();
        return $this->render('locataire/index.html.twig', [
            'locataire' => $locataire,
        ]);
    }


    /**
     * @Route("/locataire/creer", name="locataire.creer")
     */
    public function creer(Request $request)
    {
           $locataire = new Locataire();

       $form =  $this->createForm(LocataireType::class, $locataire);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $locataire = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($locataire);
         $entityManager->flush();

        return $this->redirectToRoute('locataire');
        }

        return $this->render('locataire/creer.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


     /**
     * @Route("/locataire/modifier/{id}", name="locataire.modifier.admin", methods="GET|POST")
     */
    public function modification(Request $request, Locataire $locataire)
    {
       
       $form =$this->createForm(LocataireType::class, $locataire);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $locataire = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         //$entityManager->persist($mobilier);
         $entityManager->flush();
         $this->addFlash('success', 'Informationdu locataire modifier avec succès');            

        return $this->redirectToRoute('locataire');
        }

        return $this->render('locataire/modifier.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


           /**
     * @Route("/locataire/suprimer/{id}", name="locataire.delete")
     */
       public function supprimer(Locataire $locataire)
       {
           $em= $this->getDoctrine()->getManager();
           $em->remove($locataire);
           $em->flush();
           return $this->redirectToRoute('locataire');

       }
}
