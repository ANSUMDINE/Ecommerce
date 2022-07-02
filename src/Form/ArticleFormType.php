<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'name-article form-control',
                    'placeholder' => 'Nom de l\'article',
                ] 
            ])
            ->add('description', TextType::class, [
                'label'=> false,
                'attr' => [
                    'class' => 'desc-article form-control',
                    'placeholder' => 'Description de l\'article',  
                ]
            ])
            ->add('comment', TextareaType::class, [
                'label'=> false,
                'attr' => [
                    'class' => 'commet-article form-control',
                    'placeholder' => 'Commentaire de l\'article',  
                ] 
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success' 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
