<?php

namespace App\Controller;


use App\Entity\Promo;
use App\Form\PromoType;
use App\Repository\PromoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class PromoController extends AbstractController
{
    /**
     * @var PromoRepository
     */
	private $Repository;

	public function __construct(PromoRepository $repository)
	{
		$this->repository=$repository;
		
	}	


	/**
     * @Route("/promo", name="promo")
     */
    public function index()
    {
        $promo=$this->repository->findAll();
        return $this->render('promo/index.html.twig', [
            'promo' => $promo,
        ]);
    }





    /**
     * @Route("/promo/creer", name="promo.creer")
     */
    public function creer(Request $request)
    {
           $promo = new Promo();

       $form =  $this->createForm(PromoType::class, $promo);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $promo = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($promo);
         $entityManager->flush();

        return $this->redirectToRoute('promo');
        }

        return $this->render('promo/creer.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


     /**
     * @Route("/promo/modifier/{id}", name="promo.modifier.admin", methods="GET|POST")
     */
    public function modification(Request $request, Promo $promo)
    {
       
       $form =$this->createForm(PromoType::class, $promo);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $promo = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         //$entityManager->persist($mobilier);
         $entityManager->flush();
         $this->addFlash('success', 'Informationdu promo modifier avec succès');            

        return $this->redirectToRoute('promo');
        }

        return $this->render('promo/modifier.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


           /**
     * @Route("/promo/suprimer/{id}", name="promo.delete")
     */
       public function supprimer(Promo $promo)
       {
           $em= $this->getDoctrine()->getManager();
           $em->remove($promo);
           $em->flush();
           return $this->redirectToRoute('promo');

       }
}
