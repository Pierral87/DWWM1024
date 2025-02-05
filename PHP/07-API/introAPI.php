<?php 

/*

Une API (Application Programming Interface)

Une API est un ensemble de règle permettant à plusieurs applications différentes de communiquer entre elles.
Par exemple on peut sur notre site récupérer des infos de la météo d'un site spécialisé en API météo
On peut récupérer aussi des valeurs de conversions de devise sur un site qui maintient les taux de conversion à jour en temps réel etc etc 

En PHP, on peut utiliser des API via des fonctions déjà présentes dans le langage.
file_get_contents() permet d'envoyer une requête et de récupérer un document sous forme généralement JSON que l'on peut ensuite retransformer en array avec json_decode()

*/


// Ici, appel de l'API de Open-Meteo 
// https://open-meteo.com/
$apiURL = "https://api.open-meteo.com/v1/forecast?latitude=48.8534&longitude=2.3488&current=temperature_2m&hourly=temperature_2m&timezone=auto";

// Récupération du contenu JSON 
$reponse = file_get_contents($apiURL);

// On transforme le JSON en array lisible par php 
$info = json_decode($reponse, true);

// Vérification des données récupérées par l'api et transformées en array 
// var_dump($info);

// Affichage de la temperature à Paris 
if (isset($info["current"])) {
    echo "La température actuelle à Paris est de " . $info["current"]["temperature_2m"];
} else {
    echo "Impossible de récupérer la météo";
}

/* 

    Quelques API simple pour s'entrainer: 
        - CatFacts 
        - Open Meteo 
        - IPify 
        - https://api.gouv.fr/  pour de nombreuses API officielle du gouvernement français 

    En gros : Les API nous permettent de récupérer des données externes pour les intégrer dans notre application ! 

*/


?>