<?php
namespace ICS\StoryhelperBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use ICS\StoryhelperBundle\Entity\Scene;
use ICS\StoryhelperBundle\Entity\Book;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class SceneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('resume', CKEditorType::class)
            ->add('text', CkEditorType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Scene::class,
        ]);
    }
}