<?php

/*

    3 -- Les exceptions en PHP 

    Les exceptions en PHP permettent de gérer les erreurs et des les conditions anormales de manière contrôlée.
    Contrairement à une Fatal Error qui arrête immédiatement le code, les exceptions nous offrent un moyen d'intercepter les erreurs et de les traiter proprement

    On utilisera toujours les exceptions via des blocs try/catch  
    try : bloc où l'on place le code qui peut potentiellement générer une exception 
    catch : intercepte une exception lancée et permet de la traiter
    throw : lance une exception 
    finally : est un bloc que l'on peut rajouter après le try/catch et qui s'exécutera quoi qu'il en soit, que l'on soit passé dans le catch ou pas 

*/

function diviser($a, $b)
{
    if ($b == 0) {
        // Ici une fonction avec un cas d'erreur qui lance une Exception
        // Ici c'est une instanciation d'un objet Exception, mais il n'est pas simplement créé dans une variable classique, sinon il resterait dans le scope local de la fonction ! 
        // le throw c'est un peu comme un return, c'est pour faire sortir l'exception de la fonction, mais c'est rattaché au bloc try/catch 
        throw new Exception("Division par zéro interdite !");
    }
    return $a / $b;
}


function diviser2($a, $b)
{
    if ($b == 0) {
        // Ici idem, cas d'erreur avec l'envoi d'un autre type d'Exception, les sous types d'exception possèdent les mêmes props et methodes que la classe d'origine
        throw new InvalidArgumentException("Argument invalide !");
    }
    return $a / $b;
}


echo "<h1>Avant le try/catch avec Exception Classique </h1>";
try {
    echo diviser(10, 0); // Ici cette ligne me déclenche une erreur lançant une exception, et me transporte directement dans le bloc catch
} catch (Exception $e) {
    // Dans ce bloc, je récupère l'objet Exception qui a été throw, dans la variable $e
    // J'ai accès sur cette variable aux props et méthodes de l'exception pour visualiser les détails de l'erreur, la ligne où est lancée l'exception, la ligne où est déclenchée l'erreur lançant l'exception, le message d'erreur, les arguments, la fonction lancée etc
    // var_dump($e->getTrace());
    var_dump(get_class_methods($e));
    echo "Erreur : " . $e->getMessage();
}
echo "<h1>Après le try/catch</h1>";


echo "<h1>Avant le try/catch avec InvalidArgumentException</h1>";
try {
    echo diviser2(10, 2);
} catch (InvalidArgumentException $e) {
    //   var_dump($e);
    //   var_dump(get_class_methods($e));
    echo "Erreur : " . $e->getMessage();
} catch (Exception $e) { // Je peux mettre plusieurs catch dans mon try/catch pour traiter séparément les différents types d'exception que je peux recevoir 
} finally { // Le bloc finally s'exécute quoi qu'il en soit
    echo "<hr>C'est fini !<hr>";
}
echo "<h1>Après le try/catch</h1>";


// On peut extends Exception pour créer ses propres cas d'Exception personnalisés
class NomInvalideException extends Exception {}
