<?php

namespace App\Controller;

use App\Entity\Mobilier;
use App\Form\MobilierType;
use App\Repository\MobilierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;




class MobilierController extends AbstractController
{
	/**
     * @var MobilierRepository
     */
	private $Repository;

	public function __construct(MobilierRepository $repository)
	{
		$this->repository=$repository;
		
	}	


    /**
     * @Route("/", name="mobilier")
     */
    public function index()
    {
        $mobilier=$this->repository->findAll();
        return $this->render('mobilier/index.html.twig', [
            'mobilier' => $mobilier,
        ]);
    }




        /**
     * @Route("/jours", name="jours")
     */
    public function journal()
    {


          $now = new \DateTime();
            $mobilier=$this->repository->findByDate($now);
       


        return $this->render('mobilier/jours.html.twig', [
            'mobilier' => $mobilier,
        ]);
    }

        /**
     * @Route("/mobilier/creer", name="mobilier.creer")
     */
    public function creer(Request $request)
    {
       
       $mobilier = new Mobilier();

       $form =  $this->createForm(MobilierType::class, $mobilier);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $mobilier = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($mobilier);
         $entityManager->flush();

        return $this->redirectToRoute('mobilier');
        }

        return $this->render('mobilier/creer.html.twig', [
            'form' =>$form->createView() 
        ]);
    }



       /**
     * @Route("/mobilier/creer/{id}", name="mobilier.creer.admin", methods="GET|POST")
     */
    public function modification(Request $request, Mobilier $mobilier)
    {
       
       $form =$this->createForm(MobilierType::class, $mobilier);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $mobilier = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         //$entityManager->persist($mobilier);
         $entityManager->flush();
         $this->addFlash('success', 'bien modifier avec succès');            

        return $this->redirectToRoute('mobilier');
        }

        return $this->render('mobilier/modifier.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


       /**
     * @Route("/mobilier/suprimer/{id}", name="mobilier.delete")
     */
       public function supprimer(Mobilier $mobilier)
       {
           $em= $this->getDoctrine()->getManager();
           $em->remove($mobilier);
           $em->flush();
           return $this->redirectToRoute('mobilier');

       }


}
