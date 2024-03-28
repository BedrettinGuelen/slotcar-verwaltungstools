<?php

namespace App\Controller;

use App\Entity\ModelCar;
use App\Form\ModelCarType;
use App\Repository\ModelCarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/model/car')]
class ModelCarController extends AbstractController
{
    #[Route('/', name: 'app_model_car_index', methods: ['GET'])]
    public function index(ModelCarRepository $modelCarRepository): Response
    {
        return $this->render('model_car/index.html.twig', [
            'model_cars' => $modelCarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_model_car_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $modelCar = new ModelCar();
        $form = $this->createForm(ModelCarType::class, $modelCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($modelCar);
            $entityManager->flush();

            return $this->redirectToRoute('app_model_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('model_car/new.html.twig', [
            'model_car' => $modelCar,
            'form' => $form,
        ]);
    }

    #[Route('/{ulid}', name: 'app_model_car_show', methods: ['GET'])]
    public function show(ModelCar $modelCar): Response
    {
        return $this->render('model_car/show.html.twig', [
            'model_car' => $modelCar,
        ]);
    }

    #[Route('/{ulid}/edit', name: 'app_model_car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ModelCar $modelCar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModelCarType::class, $modelCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_model_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('model_car/edit.html.twig', [
            'model_car' => $modelCar,
            'form' => $form,
        ]);
    }

    #[Route('/{ulid}', name: 'app_model_car_delete', methods: ['POST'])]
    public function delete(Request $request, ModelCar $modelCar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modelCar->getUlid(), $request->request->get('_token'))) {
            $entityManager->remove($modelCar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_model_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
