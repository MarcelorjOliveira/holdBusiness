<?php

namespace AppBundle\Form;

use AppBundle\Form\SymfonyUserForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NormalUserForm extends SymfonyUserForm{

	public function buildForm(FormBuilderInterface $builder,  array $options) {
		parent::buildForm($builder, $options);
		$builder->add('titulo', TextType::class, array('label' => 'Razão Social'))
						->add('codigoTitulo', TextType::class, array('label' => 'CNPJ'));
	}
}
