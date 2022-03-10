<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Student Name",
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 2
                ]
            ])
            ->add('address', TextType::class, [
                'label' => "Address",
                'attr' => [
                    'maxlength' => 100,
                    'minlength' => 2
                ]
            ])
            ->add('image', TextType::class, [
                'label' => "Image",
            ])
            ->add('dob', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('schoolYear', IntegerType::class, [
                'label' => "School Year",
                'attr' => [
                    'max' => 2022,
                    'min' => 2000
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => "Phone Number",
                'attr' => [
                    'length' => 10,
                ]
            ])
            ->add('classes', EntityType::class, [
                'class' => Classes::class,
                'choice_label' => 'name',
                'multiple' => true, // required.
                'expanded' => true
            ])
            ->add('Submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
