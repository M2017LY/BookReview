<?php

namespace Book\ReviewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Book\ReviewBundle\Entity\Cover;
use Symfony\Component\VarDumper\Cloner\Data;

class CoverType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cover' , FileType::class, array('label' => 'Book Cover (image)'))
            ->add('submit',SubmitType::class)
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           // 'data_class' => Data::class
            'data_class' => 'Book\ReviewBundle\Entity\Cover'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'book_reviewbundle_cover';
    }


}
