<?php

namespace App\Form;

use App\Entity\Manager;
use App\Entity\Department;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ManagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Manager Name",
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 2
                ]
            ])
            ->add('address', TextType::class, [
                'label' => "Address Name",
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 2
                ]
            ])
            ->add('image', TextType::class, [
                'label' => "image",
            ])
            ->add('dob', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('phone', TextType::class, [
                'label' => "Phone Number",
                'attr' => [
                    'length' => 10,
                ]
            ])
            // ->add('username')
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'name',
                'multiple' => true, // required.
                'expanded' => true
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Manager::class,
        ]);
    }
}
