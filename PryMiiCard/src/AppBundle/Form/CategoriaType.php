<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        print_r(isset($options));
        $builder
            ->add('id',TextType::class,array('label'=>'Codigo:','disabled'=>'true'))
            ->add('desCat', TextType::class,array('required'=>true,'label'=>'Nombre:'))
            ->add('Guardar',SubmitType::class);
        /*
        if(!isset($options)){
            $builder
                ->add('id',TextType::class,array('label'=>'Codigo:','disabled'=>'true'))
                ->add('desCat', TextType::class,array('required'=>true,'label'=>'Nombre:'))
                ->add('Modificar',SubmitType::class)
                ->add('Eliminar',SubmitType::class);
        }else{
            $builder
                ->add('desCat', TextType::class,array('required'=>true,'label'=>'Nombre:'))
                ->add('Guardar',SubmitType::class);
        }*/


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Categoria'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'AppBundle_categoria';
    }


}
