<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdministradorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomAdm',TextType::class,array('label'=>'Nombres','required'=>true))
                ->add('apeAdm',TextType::class,array('label'=>'Apellido','required'=>true))
                ->add('emAdm',EmailType::class,array('label'=>'Email Personal'))
                ->add('path',HiddenType::class,array('mapped'=>false))
                ->add('photoAdm',FileType::class,array('label'=>'Foto Personal','data_class' => null))
                ->add('useAdm',TextType::class,array('label'=>'Nombre de Usuario'))
                ->add('Guardar',SubmitType::class);

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Administrador'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_administrador';
    }


}
