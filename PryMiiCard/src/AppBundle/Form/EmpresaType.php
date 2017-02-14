<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EmpresaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEmp',TextType::class,array('label'=>'Nombre'))
                ->add('usuEmp',TextType::class,array('label'=>'Usuario'))
                ->add('pasEmp',TextType::class,array('label'=>'Password'))
                ->add('rucEmp',TextType::class,array('label'=>'RUC'))
                ->add('tlfEmp',TextType::class,array('label'=>'Telefono'))
                ->add('webEmp',TextType::class,array('label'=>'Pagina Web'))
                ->add('logEmp',TextType::class,array('label'=>'Logo'))
                ->add('slgEmp',TextType::class,array('label'=>'Eslogan'))
                ->add('registrar',SubmitType::class,array('label'=>'REGISTRAR'));
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
