<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Class Name',
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 2
                ]
            ])
            ->add('subject', TextType::class, [
                'label' => 'Subject',
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 2
                ]
            ])
            ->add('totalLesson', IntegerType::class, [
                'label' => 'Total Lesson',
                'attr' => [
                    'max' => 80,
                    'min' => 40
                ]
            ])
            ->add('lecturer', TextType::class, [
                'label' => 'Lecturer Name',
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 2
                ]
            ])
            ->add('students', EntityType::class, [
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('Submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}
