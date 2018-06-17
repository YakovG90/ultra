<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 6/17/2018
 * Time: 12:49 PM
 */

namespace App\Form\Character;


use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add
            (
                'characterName',
                TextType::class
            )
            ->add
            (
                'realmName',
                TextType::class
            )
            ->add
            (
                'save',
                SubmitType::class
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults
            ([
                'data_class' => Member::class
            ])
        ;
    }
}