<?php

namespace App\Controller;


use App\Entity\Mobilier;
use App\Form\MobilierType;
use App\Repository\MobilierRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminAgenceController extends AbstractController
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
     * @Route("/admin", name="admin_agence")
     */
    public function index()
    {
         $mobilier=$this->repository->findAll();
        return $this->render('mobilier/adminvision.html.twig', [
            'mobilier' => $mobilier,
        ]);
    }


    //public function edit



}
