<?php

namespace App\Form;

use App\Entity\Manager;
use App\Entity\Department;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DepartmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Department Name',
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 2
                ]
            ])
            ->add('hotline', TextType::class, [
                'label' => 'Department Hotline',
            ])
            ->add('email', TextType::class, [
                'label' => 'Department Email',
            ])
            ->add('room', TextType::class, [
                'label' => 'Department Room',
            ])
            ->add('manager', EntityType::class, [
                'class' => Manager::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('Submit', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Department::class,
        ]);
    }
}
