<?php

namespace App\Controller;

use App\Entity\OriginalCar;
use App\Form\OriginalCarType;
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

    public function carIndex(): Response
    {
        $originalCarRepository = $this->entityManager->getRepository(OriginalCar::class);
        return $this->render('original_car/index.html.twig', [
            'original_cars' => $originalCarRepository->findAll(),
        ]);
    }

    public function searchCar( Request $request): Response
    {
        $repository = $this->entityManager->getRepository(OriginalCar::class);

        $searchTerm = $request->query->get('car');
        $manufacturedYear = $request->query->get('manufacturedYear');
        $searchedCars = $repository->findSearchedCar(trim($searchTerm, " "), intval($manufacturedYear));

        return $this->render('original_car/index.html.twig', [
            'original_cars' => $searchedCars,
            'isSearch' => true,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $originalCar = new OriginalCar();
        $form = $this->createForm(OriginalCarType::class, $originalCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newImageName = $fileUploader->upload($imageFile);
                $originalCar->setImage($newImageName);
            }

            $this->entityManager->persist($originalCar);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('original_car/new.html.twig', [
            'original_car' => $originalCar,
            'form' => $form,
        ]);
    }

    public function show(string $ulid): Response
    {
        $originalCar = $this->entityManager->getRepository(OriginalCar::class)->find($ulid);

        if (!$originalCar) {
            throw $this->createNotFoundException('The car does not exist');
        }

        return $this->render('original_car/show.html.twig', [
            'original_car' => $originalCar,
        ]);
    }

    public function edit(Request $request, string $ulid): Response
    {
        $originalCar = $this->entityManager->getRepository(OriginalCar::class)->find($ulid);

        if (!$originalCar) {
            throw $this->createNotFoundException('No car does found with the given ulid ' . $ulid);
        }

        $form = $this->createForm(OriginalCarType::class, $originalCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('original_car/edit.html.twig', [
            'original_car' => $originalCar,
            'form' => $form,
        ]);
    }

    public function delete(string $ulid): Response
    {

        $originalCar = $this->entityManager->getRepository(OriginalCar::class)->find($ulid);

        if (!$originalCar) {
            throw $this->createNotFoundException('No car does found with the given ulid ' . $ulid);
        }

        $this->entityManager->remove($originalCar);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_original_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
