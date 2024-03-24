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


class OriginalCarController extends AbstractController
{
    public function index(OriginalCarRepository $originalCarRepository): Response
    {
        #dd($originalCarRepository->findAll());
        return $this->render('original_car/index.html.twig', [
            'original_cars' => $originalCarRepository->findAll(),
        ]);
    }

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

    public function show(OriginalCar $originalCar): Response
    {
        return $this->render('original_car/show.html.twig', [
            'original_car' => $originalCar,
        ]);
    }

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

    public function delete(Request $request, OriginalCar $originalCar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$originalCar->getUlid(), $request->request->get('_token'))) {
            $entityManager->remove($originalCar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
