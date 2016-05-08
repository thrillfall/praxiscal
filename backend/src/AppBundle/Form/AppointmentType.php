<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type;

class AppointmentType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('lastName')
                ->add('firstName')
                ->add('firstVisit', 'checkbox')
                ->add(
                        $builder
                        ->create('timeslot', 'text')
                        ->addModelTransformer(
                                    new \Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToTimestampTransformer())
                )
                ->add('praxisConfirmed', 'checkbox')
                ->add('userConfirmed', 'checkbox')
                ->add('isBlocker', 'checkbox')
                ->add('zip')
                ->add('city')
                ->add('street')
                ->add('phone')
                ->add('email', 'email')
                ->add(
                        $builder
                        ->create('birthdate', 'text')
                        ->addModelTransformer(
                         new \Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer(null, null, 'd.m.Y'))
                )                              
                ->add('services', 'collection',  ['type' => 'text', 'allow_extra_fields'  => true])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Appointment',
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_appointment';
    }

}
