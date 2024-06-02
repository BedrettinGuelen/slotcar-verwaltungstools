<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BrandController extends AbstractController
{

    public function __construct(
        protected EntityManagerInterface $entityManager
    )
    {
    }

    public function index(): Response
    {
        $brandRepository = $this->entityManager->getRepository(Brand::class);

        return $this->render('brand/index.html.twig', [
            'brands' => $brandRepository->findAll(),
        ]);
    }

    public function new(Request $request): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($brand);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_original_car_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('brand/new.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    public function show(string $ulid): Response
    {
        $brand = $this->entityManager->getRepository(Brand::class)->find($ulid);

        if (!$brand) {
            throw $this->createNotFoundException('The brand does not exist');
        }

        return $this->render('brand/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    public function edit(Request $request, string $ulid): Response
    {
        $brand = $this->entityManager->getRepository(Brand::class)->find($ulid);

        if (!$brand) {
            throw $this->createNotFoundException('No brand found for the given ulid ' . $ulid);
        }

        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('brand/edit.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    public function delete(string $ulid): Response
    {
        $brand = $this->entityManager->getRepository(Brand::class)->find($ulid);

        if (!$brand) {
            throw $this->createNotFoundException('No brand found for the given ulid ' . $ulid);
        }

        $this->entityManager->remove($brand);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_brand_index', [], Response::HTTP_SEE_OTHER);
    }
}
