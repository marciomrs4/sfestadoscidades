<?php

namespace Mrs\BlogBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Mrs\BlogBundle\Form\Listener;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('idade')
            ->add('estado', EntityType::class, array(
                'class' => 'Mrs\BlogBundle\Entity\Estados',
                'placeholder' => 'Selecione o Estado'))
            ->add('cidade',EntityType::class,
                array('class' => 'Mrs\BlogBundle\Entity\Cidades')
            );

        /*
         * ->add('estado', EntityType::class,
                array('class' => 'Mrs\BlogBundle\Entity\Estados'))

         * */
        $builder->addEventSubscriber(new Listener\AddStateFieldSubscriber());




    }



    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mrs\BlogBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mrs_blogbundle_user';
    }
}
