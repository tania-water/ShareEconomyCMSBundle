<?php

namespace Ibtikar\ShareEconomyCMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
 */
class PageType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title'])
            ->add('titleAr', TextType::class, ['label' => 'Title'])
            ->add('content', TextareaType::class, ['label' => 'Description'])
            ->add('contentAr', TextareaType::class, ['label' => 'Description']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ibtikar\ShareEconomyCMSBundle\Entity\Page'
        ]);
    }

    public function getName()
    {
        return 'page';
    }
}