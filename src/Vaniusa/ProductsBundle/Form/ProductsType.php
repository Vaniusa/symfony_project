<?php

namespace Vaniusa\ProductsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
           $builder
               ->add('nombre')
               ->add('category')
               ->add('description')
               ->add('price')
               ->add('save', SubmitType::class, array('label'=>'Crear Productos'))
           ;
    }
}