<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class,array(
        		'required'=>true))
        ->add('apellido', TextType::class,array('required'=>true))
        ->add('fechanacim',DateType::class)
        ->add('path',HiddenType::class,array('mapped'=>false))
        ->add('foto',FileType::class, array('label'=>'Tu Foto','data_class' => null))
        ->add('cedula',TextType::class)
        ->add('email',EmailType::class,array('required'=>true))
        ->add('telefono',TextType::class)
        ->add('username')
        ->add('plainPassword', RepeatedType::class, array(
        		'type' => PasswordType::class,
        		'first_options'=> array('label'=> 'Contraseña'),
        		'second_options'=> array('label'=>'Verificar contraseña')
        		)
        )       
        ->add('Registrar',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuario';
    }


}
