<?php

namespace App\Form;

use App\Entity\Abonne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo')
            ->add('agreeTerms', CheckboxType::class, [
                // Normalement, tous les champs du form doivent correspondre à une propriété de notre entité (un champ de la table). Si on veut rajouter un champ dans le form qui ne soit pas directement lié à l'entité, alors il faut ajouter l'option "mapped" => false 
                'mapped' => false,
                'constraints' => [
                    // La contrainte IsTrue équivaut à "si la case n'est pas cochée on ne peut pas valider le form"
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions générales d\'utilisation.',
                    ]),
                ],
                "label" => "J'accepte les CGU",
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                // Ici idem pour mapped false, car si je le laissais en mapped true, c'est à dire que c'est le password en clair (non hashé) qui serait transmit à l'entité et donc à ma table !!!
                // Pour raison de sécurité évidente j'ai besoin de hasher le password
                // Pour ce faire, je dois d'abord traiter le password en clair venant du form, puis gérer le hash dans le controller avant d'insérer dans la table
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            // Je rajoute ci dessous les autres champs de mon entité qui n'étaient pas présent par défaut dans le make registration-form
            ->add('prenom', TextType::class, [
                "label" => "Prenom",
                "required" => false
            ])
            ->add('nom', TextType::class, [
                "label" => "Nom",
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonne::class,
        ]);
    }
}
