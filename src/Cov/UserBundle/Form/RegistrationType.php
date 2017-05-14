<?php
/**
 * Created by PhpStorm.
 * User: asuss
 * Date: 27/01/2017
 * Time: 23:14
 */

namespace Cov\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'cov_user_registration';
    }
}