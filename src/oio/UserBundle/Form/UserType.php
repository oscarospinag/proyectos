<?php

namespace oio\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('lastName')
            ->add('firstName')
            ->add('email','email')
            ->add('password','password')
            ->add('role','choice', array('choices'=> array('ROLE_ADMIN' => 'Administrador','ROLE_USER'=>'User'), 'placeholder' => 'Select a role'))
            ->add('isActive','checkbox')
            ->add('save', 'submit', array('label' => 'Save user'))
           
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'oio\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}
