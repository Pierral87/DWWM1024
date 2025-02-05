<?php

// phpinfo();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syntaxe PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Syntaxe PHP</h2>

        <!-- Il est possible d'écrire de l'htlm dans un fichier.php  
            En revanche, l'inverse n'est pas possible ! Le serveur ne fait pas passer la lecture du fichier par l'interpréteur !  
        -->

        <?php 
        // Ouverture de la balise PHP

        // Ceci est un commentaire sur une seule ligne 
        # Ceci est un commentaire sur une seule ligne 
        /*  
            Commentaire sur 
            plusieurs lignes
        */

        // La doc officielle : 
        // https://www.php.net

        // Les bonnes pratiques et conventions d'écriture 
        // https://phptherightway.com 

        echo "<h2>01 - Instruction d'affichage</h2>";
        // echo est une instruction du langage permettant de générer un affichage 

        // Attention chaque instruction en PHP doit se terminer par un ; 

        print "Nous sommes mardi<br>"; // Autre instruction permettant de générer un affichage, on va préférer utiliser echo 

        echo "<h2>02 - Variables : déclaration / affectation / type</h2>";
        // Une variable c'est un espace nommé permettant de conserver une valeur 
        // En pohp on déclare ça avec le $ 
        // Caractères autorisés a-z A-Z 0-9 _ 
        // PHP est sensible à la casse (c'est à dire une minuscule est différente d'une majuscule)
        // Une variable ne peut pas commencer par un chiffre ! 

        // gettype() est une fonction prédéfinie qui nous permet de comprendre le type d'une variable (elle retourne un string)

        $a = 123; // Déclaration de la variable nommée 'a' et affectation de la valeur numérique 123 
        echo $a;
        echo gettype($a); // int
        echo "<br>";

        $a = 1.5; // On change la valeur contenue dans la variable $a 
        echo $a;
        echo gettype($a); // float/double 
        echo "<br>";

        $a = "Chaine de carac";
        echo $a;
        echo gettype($a); // string
        echo "<br>";

        $a = true;
        echo $a;
        echo gettype($a); // boolean

        echo "<h2>03 - Concaténation</h2>";
        // La concaténation consiste à assembler des chaines de caractères (sous forme de texte ou contenues dans des variables) les unes avec les autres
        // Le caractère de concaténation en PHP c'est : "."  le point 
        // On peut aussi concaténer avec la virgule "," mais ce n'est pas préféré 
        // Le caractère de concaténation peut toujours se traduire par "suivi de" 

        $x = "Bonjour";
        $y = "tout le monde";

        //    $z = $x . $y;

        // Sans concaténation 
        echo $x;
        echo " ";
        echo $y;
        echo "<br>";

        // Avec concaténation 
        echo $x . " " . $y . "<br>";
        echo $x, " ", $y, "<br>";
        //    print $x , " " , $y , "<br>"; // Attention la virgule ne fonctionne pas avec print ! On préfèrera donc toujours concaténer avec le "."
        // Egalement, la concaténation avec la virgule ne peut pas être utilisée pour des concaténations en affectation de variable ! 

        // Concaténation 
        $prenom = "Pierre";
        $prenom = "Alexandre"; // Ici la valeur Alexandre écrase la valeur Pierre
        echo $prenom . "<br>";
        $prenom = "Pierre";
        $prenom = $prenom . "-Alexandre";

        $prenom = "Pierre";
        $prenom .= "-Alexandre";
        echo $prenom . "<br>";

        echo "<h2>04 - Guillemets et apostrophes</h2>";

        $x = "Bonjour";
        $y = "tout le monde";

        // Entre guillemets/double quote, une variable est reconnue et donc est interprétée 
        // Entre apostrophes/simple quote, une variable ne sera pas reconnue et donc traitée comme du texte 

        echo "$x $y <br>";
        echo '$x $y <br>';

        echo "<h2>05 - Constantes</h2>";

        // Une constante comme une variable permet de conserver une valeur
        // SAUF QUE, comme son nom l'indique la valeur restera... constante ! 
        // C'est à dire on ne pourra pas changer sa valeur une fois définie
        // On parlera ici de constante "globale" car d'autres types de constantes existent

        // Déclaration et affectation : 
        define("URL", "http://www.monsite.fr/");
        echo URL . "<br>"; 

        // define("URL", "autre chose"); // Impossible, already defined 
        // URL = "qqchoz"; // Impossible, syntax error ici 

        // Constantes magiques 
        // Déjà inscrit dans le langage 
        // ATTENTION deux "__" avant et après le nom de la constante magique 

        echo __FILE__ . "<br>"; // Chemin absolue depuis le serveur vers ce fichier 
        echo __LINE__ . "<br>"; // Le numéro de cette ligne 
        echo __DIR__ . "<br>"; // Le chemin vers le dossier contenant ce fichier  

        echo "<h2>Exercice de manipulation de variables</h2>";
        // Créer 3 variables et leur assigner respectivement les valeurs suivantes :  "bleu", "blanc", "rouge"
        // Générer un affichage avec un seul echo pour obtenir "bleu - blanc - rouge"

        $bleu = "bleu";
        $blanc = "blanc";
        $rouge = "rouge";

        echo $bleu . " - " . $blanc . " - " . $rouge;
        echo "$bleu - $blanc - $rouge";

        echo "<h2>Opérateurs arithmétiques</h2>";

        $a = 10;
        $b = 5;

        // Addition 
        echo $a + $b . "<br>";
        // Soustraction 
        echo $a - $b . "<br>";
        // Multiplication : 
        echo $a * $b . "<br>";
        // Division : 
        echo $a / $b . "<br>";
        // Puissance : 
        echo $a ** $b . "<br>";
        // Modulo : 
        echo $a % $b . "<br>"; // Modulo = le reste d'une division -- On s'en sert souvent pour vérifier si un chiffre est pair ou impair 

        // Opération à l'affectation 
        $a += $b; // équivaut à dire $a = $a + $b;
        $a -= $b; // équivaut à dire $a = $a - $b;
        $a *= $b; // équivaut à dire $a = $a * $b;
        $a /= $b; // équivaut à dire $a = $a / $b;
        $a **= $b; // équivaut à dire $a = $a ** $b;
        $a %= $b; // équivaut à dire $a = $a % $b;

        echo "<h2>06 - Conditions if & opérateurs de comparaison</h2>";

        // if / elseif / else 

        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) { // Si la valeur de x est strictement supérieure à la valeur de y je rentre dans ces accolades
            echo "Vrai, la valeur de x est bien supérieure à la valeur de y <br>";
        } else {
            echo "Faux, x n'est pas supérieur à y<br>";
        }

        // Plusieurs conditions obligatoires : AND  ou && 
        if ($x > $y && $y > $z) {
            echo "Les deux conditions sont respectées<br>";
        } else {
            echo "L'une ou l'autre des conditions ou les deux sont fassues <br>";
        }

        // L'une ou l'autre d'un ensemble de conditions (au moins une d'une ensemble de conditions) OR ou || 
        if ($x > $y || $y < $z) {
            echo "Ok pour au moins une des conditions<br>";
        } else {
            echo "Toutes les conditions sont fausses <br>";
        }

        // Seulement l'une ou l'autre des conditions, si les deux sont vérifiées, c'est refusé ! 
        if ($x < $y xor $y < $z) {
            echo "Ok pour une seule et unique condition <br>";
        } else {
            echo "Toutes les conditions sont fausses ou toutes les conditions sont vraies<br>";
        }

        $x = 8;
        $y = 5;
        $z = 2;

        if ($x == 8) {
            echo "Réponse A<br>";
        } elseif ($x != 10) {
            echo "Réponse B<br>";
        } elseif ($y == $z) {
            echo "Réponse C<br>";
        } else {   // Jamais de parenthèse dans un else, il représente tous les autres cas possibles
            echo "Réponse D<br>";
        }

        // Si plusieurs cas sont juste, on sort toujours au premier cas rencontré, par exemple si x est égal à 8, la Réponse A et B sont juste, mais on sortira du bloc if à la réponse A sans tester la suite 

        // Comparaison stricte 
        $a1 = 1;
        echo gettype($a1) . "<br>";
        $a2 = "1";
        echo gettype($a2) . "<br>";

        // Comparaison des valeurs uniquement
        if ($a1 == $a2) {
            echo "Ok les deux variables sont identiques en valeur<br>";
        } else {
            echo "Non les deux variables n'ont pas la même valeur<br>";
        }

        // Comparaison des valeurs ET des types : comparaison stricte
        if ($a1 === $a2) {
            echo "Ok les deux variables sont identiques en valeur et en type<br>";
        } else {
            echo "Non les deux variables n'ont pas la même valeur ou pas le même type<br>";
        }

        /* 
            Opérateurs de comparaison
            --------------------------------
            =                       affectation (ce n'est pas un opérateur de comparaison c'est une affectation !)
            ==                      est égal à 
            !=                      est différent de 
            ===                     est strictement égal à (valeur et type)
            !==                     est strictement différent de (valeur et/ou type différent)
            >                       strictement supérieur à 
            >=                      supérieur ou égal à
            <                       strictement inférieur à 
            <=                      inférieur ou égal 
        */

        // Autres syntaxes de if 
        if ($a1 === $a2) {
            echo "Ok les deux variables sont identiques en valeur et en type<br>";
        } // Si on ne veut pas gérer le else, il est possible de ne pas le mettre 

        if ($a1 == $a2)
            if ($a1 === $a2) {
                echo "dans le petit if if";
            } else {
                echo "dans le petit if else ";
            }
        else if ($a1 == $a2)
            echo "else if";
        else
            echo "Non les deux variables n'ont pas la même valeur ou pas le même type<br>";
        // Il est possible de ne pas mettre les accolades, dans ce cas nous sommes par contre limités à une seule instruction proposée (on peut mélanger les styles ! Mais attention à la lisibilité)
        if ($a === $b) echo "dans le ternaire if";
        elseif ($a == $b) echo "b est strictement égal à c";
        else echo "pas d'égalité";

        if ($a1 === $a2)
            echo "dans le petit if if";
        else if ($a1 == $a2) {
            echo "else if";
            echo "deuxieme instruction";
        } else
            echo "Non les deux variables n'ont pas la même valeur ou pas le même type<br>";


        if ($a1 === $a2) : ?>
            Ok les deux variables sont identiques en valeur et en type<br>
            <h2>Coucou</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, quisquam laboriosam. Accusamus molestias temporibus sit quod eligendi tempora modi possimus tenetur nostrum exercitationem deleniti voluptatum accusantium id ab, aliquid fugit.</p>
        <?php else :  ?>
            "Non les deux variables n'ont pas la même valeur ou pas le même type<br>
        <?php endif;

        // Avec des : au lieu des {} puis on termine par un endif; 
        // Syntaxe utilisée régulièrement lorsque l'on ferme et réouvre PHP régulièrement (par exemple pour écrire de gros blocs HTML) pour raison de lisibilité 

        // Ecriture ternaire 
        // action (question) ? .............if..........  :  .........else........
        echo ($a1 === $a2) ? "Ok a1 et a2 strictement égaux" : "NON a1 et a2 pas égaux du tout";
        // On utilise le if ternaire lorsque l'on veut faire des if très court dont l'action est la même si on tombe dans le if ou dans le else, seulement la valeur diffère 
        echo "<hr>";

        // Deux fonctions utiles de PHP pour tester des valeurs dans des if 
        // Deux outils de controle :
        // isset() & empty()

        // isset()  permet de savoir si une information existe (si elle est "set")
        // empty() permet de savoir si une information existe MAIS aussi si elle est vide 

        $nom = "Bob";
        if (isset($nom)) { // si la variable $nom existe je rentre ici
            echo "La variable \$nom est bien définie<br>";
        } else { // si elle n'existe pas je tombe dans le else 
            echo "La variable \$nom n'existe pas<br>";
        }

        $password = "azerty";

        if (empty($password)) {
            echo "Attention, il faut absolument saisir le password!<br>";
        } else {
            echo "Tout va bien<br>";
        }

        if (!$password) {
            echo "C'est ok<br>";
        }

        // Valeurs considérées comme vide : 0, 0.0, false, FALSE, null, -0, '', "", tableau array vide 

        // isset() - très régulièrement utilisé pour vérifier que l'on reçoit bien les variables nommées de façon attendu par rapport à notre et qu'aucune n'est manquante
        // empty() - très régulièrement utilisé pour vérifier si un élément à saisi obligatoire ou un élément de vérification est vide ou au contraire n'est pas vide ! 

        // Il existe aussi les condition "switch" 
        // S'utilise uniquement pour la vérification de différentes valeurs d'un même élément, pour appliquer des "case" différents 

        $couleur = "rouge";

        switch ($couleur) { // On teste ici les différentes valeurs de la variable $couleur 
            case "bleu":
                echo "Vous aimez le bleu<br>";
                break;  // chaque break permet de clôturer un cas et de passer au suivant 
            case "rouge":
                echo "Vous aimez le rouge<br>";
                break;
            case "vert":
                echo "Vous aimez le vert<br>";
                break;
            default: // équivalent au else 
                echo "Vous n'aimez ni le bleu ni le rouge ni le vert<br>";
                break;
        }

        // EXERCICE : refaire cette condition non pas en switch mais en if / elseif / else 

        $couleur = "vert";

        if ($couleur == "bleu") echo "Vous aimez le bleu<br>";
        elseif ($couleur == "rouge") echo "Vous aimez le rouge<br>";
        elseif ($couleur == "vert") echo "Vous aimez le vert<br>";
        else echo "Vous n'aimez ni le bleu ni le rouge ni le vert<br>";

        echo "<h2>07 - Fonctions prédéfinies</h2>";

        // Les fonctions prédéfinies sont les fonctions déjà inscrites dans le langage PHP, on ne fait que les exécuter
        // Nous avons besoin quand même de connaître les arguments nécessaire au bon fonctionnement de cette fonction ainsi que du type de valeur que retournera la fonction (pour savoir comment l'exploiter)

        // Liste des fonctions prédéfinies PHP 
        // https://www.php.net/manual/en/indexes.functions.php

        // Fonction date()
        // Permet d'afficher la date du jour en choisissant le format attendu, ci dessous on défini jour/mois/année(sur4chiffres)
        echo "Voici la date : " . date("d/m/Y") . " et il est : " . date("H:i:s") . "<hr>";

        // date_default_timezone_set
        // Permet de changer la timezone sur un script, à partir de la ligne ci dessous on passe à l'heure de Tokyo ! 
        // date_default_timezone_set("Asia/Tokyo");
        // echo "Voici la date : " . date("d/m/Y") . " et il est : " . date("H:i:s");

        $timestamp = "2010-01-01";
        echo strtotime($timestamp);
        echo "Voici la date avec un timestamp : " . date("d/m/Y", strtotime($timestamp)) . " et il est : " . date("H:i:s", strtotime($timestamp)) . "<hr>";

        // Fonctions de traitement de chaine de caractères 

        // strlen() et iconv_strlen()

        echo strlen("bônjôùr") . "<br>"; // ATTENTION strlen compte en réalité le nombre d'octet de la chaine de caractères (les caractères spéciaux en valent souvent 2 !)
        echo iconv_strlen("bônjôùr") . "<br>"; // On préfèrera utiliser iconv_strlen pour compter le nombre de caractères

        // Les fonctions de test 
        // is_int, is_array, is_bool, is_string, is_numeric 

        // substr() qui permet de couper une chaine de caractères 

        // strpos() qui retourne la position d'un caractère dans une chaine (ou si c'est un mot, la position de la premiere lettre)

        // ucfirst() permet de mettre en majuscule la première lettre d'un string 

        // str_replace permet de remplacer un carac par un autre dans une chaine 
        // preg_replace permet de remplacer plusieurs carac en fonction d'une expression regulière (regex) par un autre 

        echo "<h2>08 - Fonctions utilisateur</h2>";

        // Déclarées et exécutées par le développeur 

        // Fonction toute simple qui nous renvoie 3 <hr> à afficher 
        // Déclaration
        function separateur()
        {
            return "<hr><hr><hr>";
        }

        // Exécution : 

        echo separateur();


        // Fonction avec arguments 
        // Fonction qui dit bonjour à l'utilisateur
        function ditBonjour($qui)
        {
            return "Bonjour $qui, bienvenue sur notre site. <hr>";
        }

        // return représente toujours la réponse de la fonction
        // En fonction du type de return on sait comment traiter l'exécution de la fonction, si c'est un string, potentiellement je veux l'afficher 

        echo ditBonjour("Pierra");

        // Fonction permettant de calculer un prix TTC
        function appliqueTva($prix)
        {
            return "Le montant TTC pour le prix $prix € est de : " . ($prix * 1.2) . " €<hr>"; // TVA à 20%
        }

        echo appliqueTva(100);


        // EXERCICE : refaire une fonction similaire à appliqueTVA, mais avec la possibilité de choisir le taux de taxe à appliquer, par exemple 5 pour 5% de taxe
        // Et dans un second temps, faire en sorte que si le taux de taxe n'est pas choisi, que ce soit le taux de 20% qui s'applique automatiquement

        function appliqueTva2($prix, $taux = 20)
        {
            return "Le montant TTC pour le prix $prix € et au taux de $taux % est de : " . ($prix * (1 + ($taux / 100))) . " €<hr>";
        }

        echo appliqueTva2(100, 5);
        echo appliqueTva2(100);



        // Fonction météo 
        function meteo($saison, $temperature)
        {
            $debut = "Nous sommes en " . $saison;
            $suite = " et il fait " . $temperature . " degré(s)<hr>";
            return $debut . $suite;
        }

        echo separateur();

        echo meteo("printemps", 20);
        echo meteo("été", 40);
        echo meteo("automne", 12);
        echo meteo("hiver", 1);

        // EXERCICE : refaire cette fonction en gérant "au" printemps plutôt que "en" printemps et gérer le "s" sur degré selon la valeur de la température 

        function meteo2($saison, $temperature)
        {
            if ($saison == "printemps") {
                $debut = "Nous sommes au " . $saison;
            } else {
                $debut = "Nous sommes en " . $saison;
            }

            if ($temperature == 0 || $temperature == 1 || $temperature == -1) {
                $suite = " et il fait " . $temperature . " degré<hr>";
            } else {
                $suite = " et il fait " . $temperature . " degrés<hr>";
            }

            return $debut . $suite;
        }

        echo meteo2("printemps", 20);
        echo meteo2("été", 40);
        echo meteo2("automne", 12);
        echo meteo2("hiver", 1);

        function meteo3($saison, $temperature)
        {

            $article = "en";
            $s = "s";
            if ($saison == "printemps") $article = "au";
            if (abs($temperature) <= 1) $s = "";

            return "Nous sommes $article $saison et il fait $temperature degré$s <hr>";
        }

        echo meteo3("printemps", 20);
        echo meteo3("été", 40);
        echo meteo3("automne", 12);
        echo meteo3("hiver", 1);

        function meteo4($saison, $temperature)
        {

            $article = ($saison == "printemps") ? "au" : "en";
            $s = (abs($temperature) <= 1) ? "" : "s";

            return "Nous sommes $article $saison et il fait $temperature degré$s <hr>";
        }

        echo separateur();
        echo meteo4("printemps", 20);
        echo meteo4("été", 40);
        echo meteo4("automne", 12);
        echo meteo4("hiver", 1);

        // ENVIRONNEMENT (SCOPE)
        // Global : le script complet
        // Local : à l'intérieur d'une fonction (ou d'une classe)

        // L'existence d'une variable dépend de l'environnement où on la déclare
        $animal = "chat"; // Variable déclarée dans l'espace global 
        echo $animal . "<br>";

        function foret()
        {
            $animal = "chien"; // variable déclarée dans l'espace local
            return $animal;
        }

        echo $animal . "<br>"; // chat 

        foret(); // rien, je n'ai pas demandé d'affichage avec echo, la valeur est retournée dans le vide et est perdue 
        echo $animal . "<br>"; // chat  
        echo foret() . "<br>"; // chien  
        echo $animal . "<br>"; // chat
        $animal = foret(); // changement de valeur de animal pour chien
        echo $animal; // chien

        $pays = "France"; // Variable dans l'espace global

        function changePays()
        {
            global $pays; // Avec le mot clé global, je ramène une variable de l'espace global vers mon espace local de changePays()
            $pays = "Espagne";
        }

        echo $pays; // France (je n'ai pas encore exécuté ma fonction)
        changePays(); // Changement de valeur de $pays en Espagne
        echo $pays; // Espagne 
        echo separateur();
        // Il est possible de typer les arguments d'une fonction ainsi que son return
        function identite(string|null $nom, int $age = 35, int $cp = 75000): string
        {
            return $nom . " a " . $age . "ans et habite dans le $cp<br>";
        }

        echo identite("Pierra", 37);
        // echo identite(150, "Bob"); ERREUR, il n'accepte pas Bob (string) 
        // Depuis PHP 8 on peut aussi appeler les arguments par leur nom, ce qui évite de tous les citer (surtout lorsque l'on a plusieurs arguments facultatifs et que l'on ne veut en renseigner qu'un seul ou certains)
        echo identite(nom: "lolo", cp: 47000);

        echo "<h2>09 - Structure itérative - Boucles </h2>";

        // Boucle for = boucle avec compteur numérique 
        // Besoin de 3 informations 
        // - Une valeur de départ (compteur)
        // - Une condition d'entrée
        // - Une incrémentation ou une décrémentation 

        // for(valeurDeDepart; condition ; incrementation) {}
        for ($i = 0; $i < 10; $i++) {
            echo "$i ";
        }

        echo separateur();
        // Boucle while = boucle en fonction d'une condition (pas forcément numérique)
        $i = 0;
        while ($i < 10) {
            echo "$i ";
            $i++;
        }

        // Il est possible de sortir d'une boucle avec le mot clé break;
        echo separateur();

        $i = 0;
        while ($i < 100) {
            echo "$i ";
            if ($i == 20) {
                break; // on sort de la boucle
            }
            $i++;
        }

        $i = 0;
        while ($i < 100) :
            echo "$i ";
            if ($i == 20) {
                break; // on sort de la boucle
            }
            $i++;
        endwhile;

        echo separateur();
        // EXERCICE : 

        // 1 - Afficher la suite de chiffre suivante : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 
        for ($i = 0; $i < 10; $i++) {
            if ($i < 9)  echo "$i - ";
            else echo "$i";
        }
        echo separateur();
        // 2 - Afficher des nombres allant de 1 à 100. 
        for ($i = 1; $i <= 100; $i++) {
            echo "$i ";
        }
        echo separateur();

        // 3 - Afficher des nombres allant de 1 à 100 avec le chiffre 50 en rouge.
        for ($i = 1; $i <= 100; $i++) {
            if ($i == 50) echo '<span style="color:red; font-size:20px;">' . $i . " </span>";
            else echo "$i ";
        }
        echo separateur();

        // 4 - Afficher des nombres allant de 2000 à 1930.
        for ($i = 2000; $i >= 1930; $i--) {
            echo "$i ";
        }
        echo separateur();

        // 5 - Afficher le titre suivant 10 fois : <h1>Titre à afficher 10 fois</h1>
        for ($i = 0; $i < 10; $i++) {
            echo "<h1>Titre à afficher 10 fois</h1>";
        }
        echo separateur();

        // 6 - Afficher le titre suivant "<h1>Je m'affiche pour la Nème fois</h1>".
        // Remplacer le N avec la valeur de $i (tour de boucle).
        for ($i = 1; $i < 10; $i++) {
            if ($i == 1)  echo "<h1>Je m'affiche pour la $i&egrave;re fois</h1>";
            else  echo "<h1>Je m'affiche pour la $i&egrave;me fois</h1>";
        }
        echo separateur();

        echo "<h2>10 - Tableaux de données ARRAY </h2>";
        // Array est un nouveau type de données 
        // Une variable de type array, nous permet de conserver un ensemble de valeur 
        // Un array c'est toujours composé de deux colonnes 
        // Une colonne représentant l'index/indice/id/key 
        // Une colonne représente la valeur associée à cet index 

        // Déclaration d'un tableau array 
        $tabJours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");

        // Pour voir l'intégralité d'un tableau array on ne peut pas utiliser echo 
        // echo $tabJours;  // Erreur ici Array to String conversion 

        // Deux outils de controle pour vérifier le contenu des array, var_dump et print_r 
        // Ces deux outils nous permettent de visualiser les clés et les valeurs
        var_dump($tabJours);
        echo separateur();
        echo "<pre>";
        print_r($tabJours);
        echo "</pre>";

        echo $tabJours[2] . "<br>";

        array_push($tabJours, "Samedi", "Dimanche");
        var_dump($tabJours);

        // array_unshift pour ajouter des elements en début de tableau
        // On peut utiliser unset pour supprimer un élément d'un array 

        $tabMois = ["Janvier", "Fevrier", "Mars", "Avril"];
        var_dump($tabMois);
        // Autre façon d'ajouter un élément dans un array 
        $tabMois[] = "Mai";
        $tabMois[] = "Juin";
        var_dump($tabMois);

        $tabFruits[] = "Fraise"; // cette ligne va créer le tableau
        var_dump($tabFruits);
        $tabFruits[] = "Pomme";
        $tabFruits[] = "Orange";
        $tabFruits[] = "Kiwi";

        // Pour connaitre la taille d'un array (c'est à dire le nombre d'éléments le composant)
        // count() ou sizeof()
        echo "Taille du tableau fruits : " . count($tabFruits) . "<br>";
        echo "Taille du tableau fruits : " . sizeof($tabFruits) . "<br>";

        // Mini EXERCICE : Parcourir tous les éléments de $tabFruits avec une boucle pour insérer chaque éléments dans une liste <ul><li>
        echo "<ul>";
        for ($i = 0; $i < count($tabFruits); $i++) {
            echo "<li>$tabFruits[$i]</li>";
        }
        echo "</ul>";

        // Il est possible de choisir nous-même les index et de les nommer en toutes lettre
        $membre = array("pseudo" => "Admin", "email" => "admin@mail.fr", "age" => 30);
        var_dump($membre);

        $membre["ville"] = "Paris";
        $membre["cp"] = 75000;
        var_dump($membre);

        echo $membre["pseudo"];
        // Je ne peux pas ici utiliser une boucle avec compteur numérique pour appeler mes indices car ils ne sont pas numériques ! 
        // Par contre il existe un outil spécifique à savoir la boucle foreach()   pour chaque 

        // Deux syntaxes possibles, l'une permet de récupérer uniquement les valeurs, l'autre nous permet de récupérer les clés + les valeurs 

        echo separateur();

        // Pour les valeurs uniquement 

        foreach ($membre as $valeur) { // une seule variable après "AS" cette variable reçoit la valeur en cours à chaque tour de boucle
            echo "- $valeur <br>";
        }

        // Pour les clés et les valeurs à la fois 
        foreach ($membre as $key => $valeur) { // deux variables séparées par la flèche double des array après "AS" permet de récupérer le nom de la clé dans la première variable et sa valeur dans la seconde variable
            if ($key != "age") {
                echo "- $key : $valeur <br>";
            }
        }

        // Il est possible d'avoir un tableau dans un autre tableau, on appelle ça un array multidimensionnel 

        $panier = array(
            "numProduit" => array(15, 25, 68),
            "prix"       => array(20, 35, 50),
            "quantite"   => array(1, 2, 4),
            "titreProduit" => array("pantalon", "tshirt", "chemise")
        );
        //     C:\wamp64\www\LOKI\PHP\01-Syntaxe\syntaxe.php:765:
        // array (size=4)
        //   'numProduit' => 
        //     array (size=3)
        //       0 => int 15
        //       1 => int 25
        //       2 => int 68
        //   'prix' => 
        //     array (size=3)
        //       0 => int 20
        //       1 => int 35
        //       2 => int 50
        //   'quantite' => 
        //     array (size=3)
        //       0 => int 1
        //       1 => int 2
        //       2 => int 4
        //   'titreProduit' => 
        //     array (size=3)
        //       0 => string 'pantalon' (length=8)
        //       1 => string 'tshirt' (length=6)
        //       2 => string 'chemise' (length=7)

        var_dump($panier);
        // Pour piocher dans un array à plusieurs niveaux, il faut utiliser une succession de crochets qui parcourent un à un les indices
        echo $panier["titreProduit"][2];


        // if (array_key_exists("ville", $membre)) {
        //     echo "true, the key exists<br>";
        // } else {
        //     echo "false";
        // }

        // foreach ($membre as $key => $valeur) {
        //     echo "- $key : $valeur <br>";
           
        // }

        echo "<h2>11 - Inclusion de fichier </h2>";
        // On va créer un fichier exemple.inc.php 
        // On va mettre du contenu texte et html dans ce fichier puis on va l'appeller ici grâce aux instructions include & require 

        // include & require permettent d'appeler le contenu d'un fichier extérieur pour le ramener dans ce fichier actuel
        // avec le _once on vérifie si le fichier a déjà été appelé, si c'est le cas on ne le réinclus pas ! 

        // Différence entre les deux outils ?
        // include génère une simple Warning Error, le code continue de s'exécuter
        // require génère une Fatal Error, le code s'arrête 

        echo "<b>Premier appel avec include : </b><hr>";
        include "exemple.inc.php";

        echo "<b>Deuxième appel avec include_once : </b><hr>";
        include_once "exemple.inc.php";

        echo "<b>Premier appel avec require : </b><hr>";
        require "exemple.inc.php";

        echo "<b>Deuxième appel avec require_once : </b><hr>";
        require_once "exemple.inc.php";











        // Fermeture de la balise PHP
        ?>
    </div>

</body>

</html>