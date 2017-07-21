<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class HuespedType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('fechaNacimiento')
            ->add('documento')
            ->add('documentoExpiracion')
            ->add('region')
            ->add('ciudad')
            ->add('residencia')
            ->add('numero')
            ->add('codigoPostal')
            ->add('telefono')
            ->add('celular')
            ->add('telefonoReferencia')
            ->add('fax')
            ->add('email')
            ->add('fotografia', FileType::class, array(
                    'data_class'=> null,
                    'property_path' => 'fotografia'
                )
            )
            ->add('obs')
            ->add('documentoTipo')
            ->add('generoTipo')
            ->add('paisNacimiento')
            ->add('paisNacionalidad')
            ->add('pais')
            ->add('residenciaTipo');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Huesped'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_huesped';
    }


}
