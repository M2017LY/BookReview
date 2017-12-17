<?php

namespace Book\ReviewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\VarDumper\Cloner\Data;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category')
                ->add('title')
                ->add('author')
                ->add('summary')
                 ->add('submit',SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Book\ReviewBundle\Entity\Book'
        ));
    }
//OptionRsolverInterface
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'book_reviewbundle_book';
    }


    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Book\ReviewBundle\Entity\Book',
            'csrf_protection' => false
        ));
    }
}
