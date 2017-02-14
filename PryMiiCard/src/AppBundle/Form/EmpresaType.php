<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
=======
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
>>>>>>> 5acba37f2caa573abfc432cd0695f6b0bc978ea2

class EmpresaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
<<<<<<< HEAD
        $builder->add('nomEmp',TextType::class,array('label'=>'Nombre'))
                ->add('usuEmp',TextType::class,array('label'=>'Usuario'))
                ->add('pasEmp',TextType::class,array('label'=>'Password'))
                ->add('rucEmp',TextType::class,array('label'=>'RUC'))
                ->add('tlfEmp',TextType::class,array('label'=>'Telefono'))
                ->add('webEmp',TextType::class,array('label'=>'Pagina Web'))
                ->add('logEmp',TextType::class,array('label'=>'Logo'))
                ->add('slgEmp',TextType::class,array('label'=>'Eslogan'))
                ->add('registrar',SubmitType::class,array('label'=>'REGISTRAR'));
=======
        $builder
        ->add('nomEmp', TextType::class,array('label'=>'Empresa','required'=>true, 'attr' => array('class' => 'form-control')))
        ->add('usuEmp', TextType::class,array('label'=>'Usuario','required'=>true , 'attr' => array('class' => 'form-control') ) )
        ->add('pasEmp' ,TextType::class,array('label'=>'Password','required'=>true , 'attr' => array('class' => 'form-control')) )
        ->add('rucEmp' ,TextType::class,array('label'=>'Ruc     ','required'=>true , 'attr' => array('class' => 'form-control')))
        ->add('tlfEmp' ,TextType::class,array('label'=>'Telefono','required'=>true , 'attr' => array('class' => 'form-control')))
        ->add('webEmp' ,TextType::class,array('label'=>'Pag Web','required'=>true , 'attr' => array('class' => 'form-control')))
        ->add('logEmp' ,TextType::class,array('label'=>'Logo url','required'=>true , 'attr' => array('class' => 'form-control')))
        ->add('slgEmp' ,TextType::class,array('label'=>'Solgan ','required'=>true , 'attr' => array('class' => 'form-control')))
        ->add('estEmp', ChoiceType::class, array('choices' => array('activo' => 1,'inactivo' => null) , 'attr' => array('class' => 'form-control')))
        ->add('admiPromFk' )        ;
>>>>>>> 5acba37f2caa573abfc432cd0695f6b0bc978ea2
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Empresa'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_empresa';
    }


}
