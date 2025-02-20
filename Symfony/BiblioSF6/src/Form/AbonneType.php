<?php

namespace App\Form;

use App\Entity\Abonne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class AbonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // Récupération dans la variable $abonne d'une des options passé en param, lors du edit on peut 
        // dd($options);
        $abonne = $options["data"];

        $builder
            ->add('pseudo')
            // Ici si je laisse uniquement le add("roles") sans aucun type, il va penser que c'est un input text (type par defaut)
            // Malheureusement, par rapport au mapping de l'entité, j'attends ici un array (format json dans la table), donc je dois le régler en le mettant en ChoiceType
            // Et surtout en multiple true 
            ->add('roles', ChoiceType::class, [
                "choices" => [
                    "Directeur" => "ROLE_ADMIN",
                    "Bibliothecaire" => "ROLE_BIBLIO",
                    "Lecteur" => "ROLE_LECTEUR"
                ],
                // multiple true, c'est laisser la possibilité de plusieurs valeurs dans le champs en question
                "multiple" => true,
                // expanded pour afficher une liste ici en checkbox
                "expanded" => true
            ])
            ->add('password', TextType::class, [
                // Ici pour le password je met mapped false, sinon, ce champ est rattaché directement à notre entité et les password seront alors enregistrés en clair ! Je dois donc le "détacher" de l'entité, pour le manipuler, pour ensuite dans mon controller, utiliser le setter pour lui transmettre le password hashé
                "mapped" => false,
                // "constraints" => [
                //     new Regex([
                //         // Ici un pattern forçant une min, une maj, un chiffre, un caractère spécial, entre 6 et 10 carac
                //         "pattern" => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[\d])(?=.*[-+!*$@%_])([-+!*$@%_\w]{6,10})$/",
                //         "message" => "Attention votre mdp ne correspond pas au pattern, au moins 1 min 1 maj 1 chiffre 1 carac spécial et faire entre 6 et 10"
                //     ])
                // ]
                // Ici, grâce à l'entité $abonne que j'ai récupérée via les options, je peux vérifier si un id existe dans l'entité !
                // S'il n'y a pas d'id, c'est à dire que je suis dans un contexte d'insertion (l'id est null en attendant la première insertion), donc le champ password est required ! Par contre, si getId() me retourne bien un id, alors l'entité possède un id, donc elle existe déjà en table de données, DONC je suis dans un contexte de modification, le champ n'est plus required
                "required" => $abonne->getId() ? false : true
            ])
            ->add('prenom')
            ->add('nom')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonne::class,
        ]);
    }
}
