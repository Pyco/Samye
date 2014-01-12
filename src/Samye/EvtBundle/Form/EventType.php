<?php

namespace Samye\EvtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
		
        $builder
            ->add('libelle',		'text')
            ->add('dateDeb',		'date')
            ->add('duree',			'integer')
            ->add('lieu',			'text')
			->add('heureDeb',		'time')
			->add('heureFin',		'time')
			->add('category', 		'entity',		array(
												'class'		=>	'Samye\EvtBundle\Entity\EvtCategory',
												'property'	=>	'libelle'						
				))
			->add('status',			'entity',		array(
												'class'		=>	'Samye\EvtBundle\Entity\EvtStatus',
												'property'	=>	'libelle'
				))
			->add('participation',	'money')
			->add('description',	'textarea')
											
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Samye\EvtBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'samye_evtbundle_event';
    }
}
