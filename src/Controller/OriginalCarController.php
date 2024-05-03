<?php

namespace App\Controller;

use App\Entity\OriginalCar;
use App\Form\OriginalCarType;
use App\Repository\OriginalCarRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OriginalCarController extends AbstractController
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    public function index(): Response
    {
        return $this->redirectToRoute('app_original_car_index');
    }
    public function carIndex(OriginalCarRepository $originalCarRepository): Response
    {
        return $this->render('original_car/index.html.twig', [
            'original_cars' => $originalCarRepository->findAll(),
        ]);
    }

    public function searchCar(OriginalCarRepository $repository, Request $request): Response
    {
        $searchTerm = $request->query->get('car');
        $manufacturedYear = $request->query->get('manufacturedYear');
        $searchedCars = $repository->findSearchedCar(trim($searchTerm," "), intval($manufacturedYear));

        return $this->render('original_car/index.html.twig', [
            'original_cars' => $searchedCars,
            'isSearch' => true,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $originalCar = new OriginalCar();
        $form = $this->createForm(OriginalCarType::class, $originalCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if($imageFile){
                $newImageName = $fileUploader->upload($imageFile);
                $originalCar->setImage($newImageName);
            }

            $entityManager->persist($originalCar);
            $entityManager->flush();

            return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('original_car/new.html.twig', [
            'original_car' => $originalCar,
            'form' => $form,
        ]);
    }

    public function show(
        OriginalCar $originalCar): Response
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
