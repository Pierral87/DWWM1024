<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'titre',
                TextType::class,
                [
                    "label" => "Titre du livre",
                    "constraints" => [
                        new Length([
                            "min" => 4,
                            "minMessage" => "Le titre doit avoir au moins 4 caractères",
                            "max" => 50,
                            "maxMessage" => "Le titre doit faire moins de 50 caractères"
                        ]),
                        new NotBlank([
                            "message" => "Le titre ne peut pas être vide"
                        ])
                    ]
                ]
            )
            ->add(
                'auteur',
                TextType::class,
                [
                    "label" => "Nom de l'auteur"
                ]
            )
            ->add("categorie", EntityType::class, [
                "class" => Categorie::class,
                "choice_label" => "titre", // ici titre, on comprend le titre de la categorie, ce sera le titre de la categorie qui sera affiché pour choisir la catégorie en question
                "required" => false,
                "label" => "Catégorie"
            ])
            ->add(
                "enregistrer",
                SubmitType::class,
                [
                    "label" => $options["edit_mode"] ? "Modifier" : "Enregistrer",
                    "attr" => [
                        "class" => "btn btn-success"
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
            "edit_mode" => false
        ]);
    }
}
