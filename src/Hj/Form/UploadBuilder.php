<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Form;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UploadBuilder
 * @package Hj\Form
 *
 * @todo rename
 */
class UploadBuilder
{
    /**
     * @var FormBuilderInterface
     */
    private $builder;

    /**
     * @param FormBuilderInterface $builder
     */
    public function __construct(FormBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return \Symfony\Component\Form\Form
     */
    public function build()
    {
        $this->builder->add('file', 'file');
        $this->builder->add('submit', 'submit');

        return $this->builder->getForm();
    }
}