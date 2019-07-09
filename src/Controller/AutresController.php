<?php

namespace App\Controller;

use App\Entity\Autres;
use App\Form\AutresType;
use App\Repository\AutresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/autres")
 */
class AutresController extends AbstractController
{
    /**
     * @Route("/", name="autres_index", methods={"GET"})
     */
    public function index(AutresRepository $autresRepository): Response
    {
        return $this->render('autres/index.html.twig', [
            'autres' => $autresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="autres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $autre = new Autres();
        $form = $this->createForm(AutresType::class, $autre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($autre);
            $entityManager->flush();

            return $this->redirectToRoute('autres_index');
        }

        return $this->render('autres/new.html.twig', [
            'autre' => $autre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="autres_show", methods={"GET"})
     */
    public function show(Autres $autre): Response
    {
        return $this->render('autres/show.html.twig', [
            'autre' => $autre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="autres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Autres $autre): Response
    {
        $form = $this->createForm(AutresType::class, $autre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('autres_index', [
                'id' => $autre->getId(),
            ]);
        }

        return $this->render('autres/edit.html.twig', [
            'autre' => $autre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="autres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Autres $autre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($autre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('autres_index');
    }
}
