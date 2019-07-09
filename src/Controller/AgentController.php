<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Symfony\Component\HttpFoundation\Request;

class AgentController extends AbstractController
{

	/**
     * @var AgentRepository
     */
	private $Repository;

	public function __construct(AgentRepository $repository)
	{
		$this->repository=$repository;
		
	}	


	/**
     * @Route("/agent", name="agent")
     */
    public function index()
    {
        $agent=$this->repository->findAll();
        return $this->render('agent/index.html.twig', [
            'agent' => $agent,
        ]);
    }


    /**
     * @Route("/agent/creer", name="agent.creer")
     */
    public function creer(Request $request)
    {
           $agent = new Agent();

       $form =  $this->createForm(AgentType::class, $agent);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $agent = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($agent);
         $entityManager->flush();

        return $this->redirectToRoute('agent');
        }

        return $this->render('agent/creer.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


     /**
     * @Route("/agent/modifier/{id}", name="agent.modifier.admin", methods="GET|POST")
     */
    public function modification(Request $request, Agent $agent)
    {
       
       $form =$this->createForm(AgentType::class, $agent);
       
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $agent = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
         //$entityManager->persist($mobilier);
         $entityManager->flush();
         $this->addFlash('success', 'Information de lagent modifier avec succès');            

        return $this->redirectToRoute('agent');
        }

        return $this->render('agent/modifier.html.twig', [
            'form' =>$form->createView() 
        ]);
    }


           /**
     * @Route("/agent/suprimer/{id}", name="agent.delete")
     */
       public function supprimer(Agent $agent)
       {
           $em= $this->getDoctrine()->getManager();
           $em->remove($agent);
           $em->flush();
           return $this->redirectToRoute('agent');

       }
}
