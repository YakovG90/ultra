<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/16/2018
 * Time: 7:45 PM
 */

namespace App\Form;


use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditMemberPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'plainPassword',
                RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'New password'
                ],
                'second_options' => [
                    'label' => 'Repeat password'
                ],
                    ])
            ->add(
                'save',
                SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
            'validation_groups' => ['password']
        ]);
    }
}