<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/', name: 'student_index')]
    public function studentIndex()
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/detail/{id}', name: 'student_detail')]
    public function studentDetail($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error", "This student not found!");
            return $this->redirectToRoute('student_index');
        }
        return $this->render('student/detail.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/add', name: 'student_add')]
    public function studentAdd(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm('student/add.html.twig', [
            'studentForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'student_edit')]
    public function studentEdit(Request $request, $id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm('student/edit.html.twig', [
            'studentForm' => $form
        ]);
    }

    #[Route('/delete/{id}', name: 'student_delete')]
    public function studentDelete($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error", "This student not found!");
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash("Success", "Delete student successful!");
        }
        return $this->redirectToRoute('student_index');
    }

    //Sort by student name
    #[Route('/asc', name: 'sort_asc')]
    public function sortAsc(StudentRepository $repository)
    {
        $student = $repository->sortNameAscending();
        return $this->render('student/index.html.twig', [
            'students' => $student,
        ]);
    }

    #[Route('/desc', name: 'sort_desc')]
    public function sortDesc(StudentRepository $repository)
    {
        $student = $repository->sortNameDescending();
        return $this->render('student/index.html.twig', [
            'students' => $student,
        ]);
    }
}
