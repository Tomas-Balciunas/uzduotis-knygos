<?php

namespace App\Controller;

use App\Entity\Knyga;
use App\Form\KnygaType;
use App\Repository\KnygaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/knygos')]
final class KnygaController extends AbstractController
{
    #[Route(name: 'knygos')]
    public function all(KnygaRepository $repo): Response
    {
        $knygos = $repo->findAll();

        return $this->render('knygos/knygos.html.twig', [
            'knygos' => $knygos,
        ]);
    }

    #[Route('/nauja', name: 'nauja_knyga', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $manager, Request $request): Response
    {
        $knyga = new Knyga();
        $form = $this->createForm(KnygaType::class, $knyga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($knyga);
            $manager->flush();

            $this->addFlash('info', 'Knyga pridėta.');

            return $this->redirectToRoute('knygos');
        }

        return $this->render('knygos/prideti.html.twig', [
            'knygosForma' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'knyga', methods: ['GET'])]
    public function get(Knyga $knyga): Response
    {
        return $this->render('knygos/knyga.html.twig', [
            'knyga' => $knyga,
        ]);
    }

    #[Route('/{id}/salinti', name: 'salinti_knyga', methods: ['GET'])]
    public function remove(Knyga $knyga, EntityManagerInterface $manager): Response
    {
        $manager->remove($knyga);
        $manager->flush();

        $this->addFlash('info', 'Knyga pašalinta.');

        return $this->redirectToRoute('knygos');
    }

    #[Route('/{id}/redagavimas', name: 'redaguoti_knyga', methods: ['GET', 'POST'])]
    public function edit(Knyga $knyga, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(KnygaType::class, $knyga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($knyga);
            $manager->flush();

            $this->addFlash('info', 'Knygos informacija atnaujinta.');

            return $this->redirectToRoute('knygos');
        }

        return $this->render('knygos/redaguoti.html.twig', [
            'knyga' => $knyga,
            'redagavimoForma' => $form->createView(),
        ]);
    }
}
