<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/16/2018
 * Time: 7:01 PM
 */

namespace App\Form;


use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditMemberEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'method' => 'POST',
                'label' => false,
                'attr' => [
                    'placeholder value' => ''
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver
            ->setDefaults([
                'data_class' => Member::class,
                'validation_groups' => ['email']
            ]);
    }
}