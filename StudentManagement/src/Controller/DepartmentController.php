<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DepartmentController extends AbstractController
{
    #[Route('/department', name: 'department_index')]
    public function departmentIndex()
    {
        $departmentall = $this->getDoctrine()->getRepository(Department::class)->findAll();
        return $this->render('department/index.html.twig', [
            'departmentall' => $departmentall,
        ]);
    }

    #[Route('/department/detail/{id}', name: 'department_detail')]
    public function departmentDetail($id)
    {
        $department = $this->getDoctrine()->getRepository(Department::class)->find($id);
        if ($department == null) {
            $this->addFlash("Error", "This department not found!");
            return $this->redirectToRoute('department_index');
        }
        return $this->render('department/detail.html.twig', [
            'department' => $department,
        ]);
    }

    #[Route('/department/add', name: 'department_add')]
    public function managerAdd(Request $request)
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $d = $this->getDoctrine()->getManager();
            $d->persist($department);
            $d->flush();
            return $this->redirectToRoute('department_index');
        }
        return $this->renderForm('department/add.html.twig', [
            'departmentForm' => $form
        ]);
    }


    #[Route('/department/edit/{id}', name: 'department_edit')]
    public function departmentEdit(Request $request, $id)
    {
        $department = $this->getDoctrine()->getRepository(Department::class)->find($id);
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $d = $this->getDoctrine()->getManager();
            $d->persist($department);
            $d->flush();
            return $this->redirectToRoute('department_index');
        }
        return $this->renderForm('department/add.html.twig', [
            'departmentForm' => $form
        ]);
    }

    #[Route('/department/delete/{id}', name: 'department_delete')]
    public function departmentDelete($id)
    {
        $department = $this->getDoctrine()->getRepository(Department::class)->find($id);
        if ($department == null) {
            $this->addFlash("Error", "This department not found!");
        } else {
            $d = $this->getDoctrine()->getManager();
            $d->remove($department);
            $d->flush();
            $this->addFlash("Success", "Delete department successful!");
        }
        return $this->redirectToRoute('department_index');
    }

}
