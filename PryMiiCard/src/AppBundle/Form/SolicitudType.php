<?php
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class SolicitudType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        

        ->add('nomEmp', TextType::class,array('label'=>'Empresa','required'=>true, 'attr' => array('class' => 'form-control')))
        ->add('usuEmp', TextType::class,array('label'=>'Usuario','required'=>true , 'attr' => array('class' => 'form-control') ) )
        ->add('rucEmp' ,TextType::class,array('label'=>'Ruc     ','required'=>true , 'attr' => array('class' => 'form-control')))
        ->add('tlfEmp' ,TextType::class,array('label'=>'Telefono','required'=>true , 'attr' => array('class' => 'form-control')))   
        ;
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