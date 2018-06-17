<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/16/2018
 * Time: 7:51 PM
 */

namespace App\Form;


use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditMemberNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'method' => 'POST',
                    'label' => false,
                ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Member::class,
                'validation_groups' => 'username'
            ]);
    }
}