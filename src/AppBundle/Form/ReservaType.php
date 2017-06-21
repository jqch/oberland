<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('fechaIngreso')
        ->add('fechaSalida')
        ->add('horarioEntradaEstimado')
        //->add('fechaRegistro')
        //->add('horaRegistro')
        ->add('obs')
        ->add('precioActual')
        ->add('habitacion')
        ->add('huesped', 'AppBundle\Form\HuespedType')
        ->add('reservaEstadoTipo');
        //->add('usuario');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reserva'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_reserva';
    }


}
