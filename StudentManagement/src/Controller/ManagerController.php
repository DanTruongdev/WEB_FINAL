<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Form\ManagerType;
use App\Repository\ManagerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ManagerController extends AbstractController
{
    #[Route('/manager', name: 'manager_index')]
    public function managerIndex()
    {
        $managers = $this->getDoctrine()->getRepository(Manager::class)->findAll();
        return $this->render("manager/index.html.twig", [
            'managers' => $managers ,
        ]);
    }

    #[Route('/manager/detail/{id}', name: 'manager_detail')]
    public function managerDetail($id)
    {
        $manager = $this->getDoctrine()->getRepository(Manager::class)->find($id);
        if ($manager == null) {
            $this->addFlash("Error", "This manager not found!");
            return $this->redirectToRoute('manager_index');
        }
        return $this->render('manager/detail.html.twig', [
            'manager' => $manager,
        ]);
    }

    #[Route('/manager/delete/{id}', name: 'manager_delete')]
    public function managerDelete($id)
    {
        $manager = $this->getDoctrine()->getRepository(Manager::class)->find($id);
        if ($manager == null) {
            $this->addFlash("Error", "This manager not found!");
        } else {
            $d = $this->getDoctrine()->getManager();
            $d->remove($manager);
            $d->flush();
            $this->addFlash("Success", "Delete manager successful!");
        }
        return $this->redirectToRoute('manager_index');
    }

    #[Route('/manager/add', name: 'manager_add')]
    public function managertAdd(Request $request)
    {
        $manager = new Manager();
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $d = $this->getDoctrine()->getManager();
            $d->persist($manager);
            $d->flush();
            return $this->redirectToRoute('manager_index');
        }
        return $this->renderForm('manager/add.html.twig', [
            'managerForm' => $form
        ]);
    }

    #[Route('/manager/edit/{id}', name: 'manager_edit')]
    public function managerEdit(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getRepository(Manager::class)->find($id);
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $d = $this->getDoctrine()->getManager();
            $d->persist($manager);
            $d->flush();
            return $this->redirectToRoute('manager_index');
        }
        return $this->renderForm('manager/add.html.twig', [
            'managerForm' => $form
        ]);
    }
}
