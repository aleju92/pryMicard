<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PromocionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titProm',TextType::class,array('label'=>'Titulo'))
                ->add('detProm',TextareaType::class,array('label'=>'Detalle'))
                ->add('tipProm',CheckboxType::class,array('label'=>'Limitada'))
                ->add('numProm',IntegerType::class,array('label'=>'Numero de Promociones'))
                ->add('preProm',MoneyType::class,array('label'=>'Precio'))
                ->add('fechInProm',DateTimeType::class,array('label'=>'Fecha Inicial'))
                ->add('fechFinProm',DateTimeType::class,array('label'=>'Fecha Final'))
                ->add('catPromFk',ChoiceType::class,array('label'=>'Categoria'))
                ->add('registrar',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Promocion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_promocion';
    }

    private function cargarCat()
    {
        $em=$this->getDoctrine()->getManager();
        $categorias= $em->getRepository('AppBundle:Categoria')->findAll();
        for ($categorias){
            if($categorias->getId()==1){}
        }
    }


}
