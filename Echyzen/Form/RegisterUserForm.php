<?php

namespace Echyzen\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;

class RegisterUserForm extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder->add('username', 'text', array('constraints' => new Constraints\NotBlank(array('message' => 'Champs obligatoire'))))
            ->add('password', 'text', array('constraints' => array(new Constraints\NotBlank(array('message' => 'Champs obligatoire')))));
    }

    public function getName()
    {
        return 'registeruser';
    }
}