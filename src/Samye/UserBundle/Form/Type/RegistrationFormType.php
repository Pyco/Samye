<?php

namespace Samye\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('userType', 		'choice',		array(
												'choices'		=>	array('mairie'=>'Mairie', 'asso'=>'Association')						
				));
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Samye\UserBundle\Entity\User'
        ));
    }
  
    public function getName()
    {
        return 'samye_user_registration';
    }

}