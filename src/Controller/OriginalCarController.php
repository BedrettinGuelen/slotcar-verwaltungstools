<?php

namespace App\Controller;

use App\Entity\OriginalCar;
use App\Form\OriginalCarType;
use App\Repository\OriginalCarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/original/car')]
class OriginalCarController extends AbstractController
{
    #[Route('/', name: 'app_original_car_index', methods: ['GET'])]
    public function index(OriginalCarRepository $originalCarRepository): Response
    {
        return $this->render('original_car/index.html.twig', [
            'original_cars' => $originalCarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_original_car_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $originalCar = new OriginalCar();
        $form = $this->createForm(OriginalCarType::class, $originalCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($originalCar);
            $entityManager->flush();

            return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('original_car/new.html.twig', [
            'original_car' => $originalCar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_original_car_show', methods: ['GET'])]
    public function show(OriginalCar $originalCar): Response
    {
        return $this->render('original_car/show.html.twig', [
            'original_car' => $originalCar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_original_car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OriginalCar $originalCar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OriginalCarType::class, $originalCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('original_car/edit.html.twig', [
            'original_car' => $originalCar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_original_car_delete', methods: ['POST'])]
    public function delete(Request $request, OriginalCar $originalCar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$originalCar->getId(), $request->request->get('_token'))) {
            $entityManager->remove($originalCar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
