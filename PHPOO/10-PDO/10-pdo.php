<?php

// ------------------------------------------------------------------------------
// ------------------------------------------------------------------------------
// ---------- PDO : PHP DATA OBJECT ---------------------------------------------
// ------------------------------------------------------------------------------
// ------------------------------------------------------------------------------


//  PDO est une classe prédéfinie de PHP, elle représente une connexion à un serveur de BDD 
// On va le manipuler avec MySQL mais on peut le manipuler avec d'autres SGBD
// En quelques sortes, on peut considérer que PDO est une "porte" vers notre BDD 


echo "<h2>01 - Connexion à la BDD</h2>";
// Pour créer une connexion à la BDD nous avons besoin de plusieurs informations (voir doc pour plus de détails) 
// - Le host et nom de bdd 
// - Le login de connexion à la bdd 
// - Le password de connexion de ce login 
// - Eventuellement un array contenant des options 

$host = "mysql:host=localhost;dbname=entreprise"; // hôte + nom de bdd 
$login = "root";
$password = "";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Gestion des erreurs 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

// Création de l'objet PDO : 
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de BDD";
    exit;
}


// Si le var_dump me présente bien un objet PDO, alors c'est bon, j'ai réussi à me connecter à ma BDD 
var_dump($pdo);


echo "<h2>02 - Requêtes de type action (INSERT / UPDATE / DELETE)</h2>";

// Enregistrement d'un nouvel employé dans la BDD 

// On va utiliser ici la méthode "query" qui lance une requête directement (un peu comme on les lance dans notre console)
// /!\ ATTENTION /!\  à l'utilisation de la méthode query, elle ne nous protège pas des injections SQL !!!!
// On utilisera query uniquement lorsque nous n'avons pas de $variables dans notre requête



// $stmt = $pdo->query("INSERT INTO employes (prenom, nom, salaire, sexe, date_embauche, service) VALUES ('Pierral', 'Lacaze', 12000, 'm', CURDATE(), 'Web')");

// $stmt est un objet de type PDOStatement, c'est une sorte de sous objet de PDO qui "représente" la réponse à une requête
// Pas vraiment de réponse sur une requête de type action, mais on a accès à quelques méthodes et informations

// Il sera intéressant d'utiliser rowCount pour de nombreuses opérations, par exemple savoir si un pseudo n'est pas déjà pris en bdd (si rowCount != 0 alors pseudo déjà pris)
// Egalement, pour afficher le nombre d'éléments récupérés par une requête SELECT (par ex :  back office gestion utilisateurs, pour afficher le nombre de users total)
// echo "Nombre de lignes impactées par la requête : " . $stmt->rowCount() . "<hr>";


echo "<h2>03 - Requêtes de sélection pour une seule ligne de résultat</h2>";

$stmt = $pdo->query("SELECT * FROM employes WHERE id_employes = 995");

//  La requête ci-dessus envoyée dans la console : 
// +-------------+---------+--------+------+---------+---------------+---------+
// | id_employes | prenom  | nom    | sexe | service | date_embauche | salaire |
// +-------------+---------+--------+------+---------+---------------+---------+
// |         995 | Pierral | Lacaze | m    | Web     | 2024-12-19    |   12000 |
// +-------------+---------+--------+------+---------+---------------+---------+

var_dump($stmt);

// Actuellement, je ne peux pas exploiter la réponse de la BDD, je n'ai accès à aucune information dans l'objet PDOStatement, sauf une props m'indiquant la requête lancée 
// Pour la rendre exploitable, il faut transformer/extraire le résultat grâce à la méthode fetch()

// FETCH_ASSOC : Pour récupérer un array associatif ! (nom des colonnes du résultat comme keys du array)
$data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// array (size=7)
//   'id_employes' => int 995
//   'prenom' => string 'Pierral' (length=7)
//   'nom' => string 'Lacaze' (length=6)
//   'sexe' => string 'm' (length=1)
//   'service' => string 'Web' (length=3)
//   'date_embauche' => string '2024-12-19' (length=10)
//   'salaire' => float 12000

// FETCH_NUM : Pour récupérer un array indexé numériquement 
// $data = $stmt->fetch(PDO::FETCH_NUM);
// var_dump($data);
// array (size=7)
//   0 => int 995
//   1 => string 'Pierral' (length=7)
//   2 => string 'Lacaze' (length=6)
//   3 => string 'm' (length=1)
//   4 => string 'Web' (length=3)
//   5 => string '2024-12-19' (length=10)
//   6 => float 12000

// FETCH_BOTH : Pour récupérer un array indexé numériquement et associativement (Pas très pratique, si j'utilise un foreach je vais passer deux fois sur chaque élément...)
// $data = $stmt->fetch(PDO::FETCH_BOTH);
// var_dump($data);

// FETCH_OBJ : Pour récupérer non pas un array, mais un objet ! Avec les propriétés de cet objet qui correspondront aux colonnes de mon résultat !
// $data = $stmt->fetch(PDO::FETCH_OBJ);
var_dump($data);

// echo $data["prenom"] . "<hr>";
// echo $data[1] . "<hr>";
echo $data->prenom . "<hr>";

//  Une ligne traitée avec fetch, n'existe plus dans la réponse ! C'est pour ça que je ne peux pas refaire fetch plusieurs fois à la suite sur ce résultat à une seule ligne 

echo "<h2>04 - Requêtes de sélection pour plusieurs lignes de résultat</h2>";

$stmt = $pdo->query("SELECT * FROM employes");

echo "Nombre d'employés : " . $stmt->rowCount() . "<hr>";

// fetch() ne traite qu'une seule ligne à la fois ! 
// A chaque fois que je l'appelle, il traite une ligne de plus et une autre et une autre, une par une ! 
// Pour traiter un résultat à plusieurs lignes avec fetch je peux faire une boucle ! 
// L'utilisation de la boucle while est judicieuse car elle tourne tant qu'il y a des résultats dans le stmt 
// fetch() me renvoie false lorsqu'il n'y a plus de résultats, donc la boucle s'arrête d'elle même

// while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     var_dump($data);
//     echo "<hr>";
// }

// Libre à nous de l'interprêter comme on le souhaite ensuite dans le front 
// tableau, cards, list, vignettes ou autre (cf les exercices PHP, GET/POST  gestion utilisateurs notamment )


// Ici des petites zones bleues en CSS
echo '<div style="display:flex; flex-wrap: wrap; justify-content: space-between">';
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <div style="margin-top: 20px; padding: 1%; width: 20%; background-color: steelblue; color: white">
        ID : <?= $ligne['id_employes'] ?><br>
        Prénom :<?= $ligne['prenom'] ?><br>
        Nom :<?= $ligne['nom'] ?><br>
        Service :<?= $ligne['service'] ?><br>
        Salaire :<?= $ligne['salaire'] ?><br>
        Sexe :<?= $ligne['sexe'] ?><br>
        Date embauche :<?= $ligne['date_embauche'] ?><br>
    </div>
<?php endwhile;
echo '</div><br><br>';



$stmt = $pdo->query("SELECT * FROM employes");

// Ici un tableau html à structure fixe 
echo '<style>th, td { padding: 10px; } </style>';
echo '<table border="1" style="border-collapse : collapse; width:100%;">';

echo '<tr>';
echo '<th>Id employes </th>';
echo '<th>Prénom </th>';
echo '<th>Nom </th>';
echo '<th>Sexe </th>';
echo '<th>Service </th>';
echo '<th>Date embauche </th>';
echo '<th>Salaire </th>';
echo '</tr>';

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo '<td>' . $valeur . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

echo '<hr><hr><hr>';


// Ici on va mettre en place un code qui permettra de s'adapter à n'importe quelle requête et va gérer la structure du tableau automatiquement 
$stmt = $pdo->query("SELECT prenom, nom FROM employes");
// Il existe une méthode dans PDOStatement columnCount() 
// Elle me permet de comprendre le nombre de colonne dans la réponse 
// Il existe aussi une méthode getColumnMeta() qui prends en param un int qui correspond à une colonne (0 correspondra à la première colonne du résultat)
// getColumnMeta me renvoie des informations sur la colonne en question notamment son nom !   (attribut : name)
//    echo "Nombre de colonnes dans le résultat : " . $stmt->columnCount();

//    var_dump($stmt->getColumnMeta(0));

echo '<table border="1" style="border-collapse : collapse; width:100%;">';
echo '<tr>';
for ($i = 0; $i < $stmt->columnCount(); $i++) {
    $infoColonne = $stmt->getColumnMeta($i);
    echo "<th>" . ucfirst($infoColonne["name"]) . "</th>";
}
echo "</tr>";

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    foreach ($ligne as $valeur) {
        echo '<td>' . $valeur . '</td>';
    }
    echo '</tr>';
}

echo '</table>';
echo '<hr><hr><hr>';


echo "<h2>05 - Requêtes de sélection pour plusieurs lignes de résultat avec fetchAll()</h2>";

// fetch() permet de traiter une seule ligne à la fois !
// fetchAll() traite toutes les lignes en une seule fois sauf que l'on obtient un tableau array à plusieurs niveaux

$stmt = $pdo->query("SELECT * FROM employes");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($data);

echo "Premier employé de la BDD : " . $data[0]["prenom"] . "<hr>";


//  EXERCICE : Affichez les noms et prénoms des employés dans une liste ul li 
// Le faire avec fetch 
// Le faire aussi avec fetchAll


$stmt = $pdo->query("SELECT nom, prenom FROM employes");
echo "<ul>";
while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<li>" . $data["nom"] . " " . $data["prenom"] . "</li>";
}
echo "</ul><hr><hr>";

$stmt = $pdo->query("SELECT nom, prenom FROM employes");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<ul>";
foreach($data AS $employe){
    echo "<li>" . $employe["nom"] . " " . $employe["prenom"] . "</li>";
}
echo "</ul>";


echo "<h2>06 - Requêtes préparées pour se protéger des injections SQL !</h2>";

// prepare() permet de sécuriser les requêtes pour éviter les injections SQL 
// Si dans la requête on attend une information de l'utilisateur (saisie ou clic) alors OBLIGATION de faire prepare (dans le doute, on peut toujours lancer nos requêtes en prepare)

$nom = "laborde"; // Information supposée récupérée d'un formulaire. Un utilisateur recherche des employés par une saisie du nom de famille 

// Première étape : Préparation de la requête 

// Première syntaxe possible, avec des "?" remplaçant les valeurs attendues à réinsérer au niveau du execute
// Cette syntaxe, bien que rapide, manque de lisibilité...
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = ?");
$stmt->execute([$nom]);    // On fourni dans les param du execute, un array qui contient les valeurs à coller à la place de nos ? (DANS L'ORDRE!)
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);



// Sur des requêtes à nombreux param, cela complexifie la lisibilité...
// $stmt = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES (?, ?, ?, ?, ?, ?)");
// $stmt->execute([$prenom, $nom, $sexe, $service, $salaire, $date_embauche]);




// On préfèrera la façon en utilisant des "tokens"   "marqueurs nominatif"
$stmt = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // On nomme les valeurs attendus par un mot précédé de ":"
$stmt->bindParam(":nom", $nom, PDO::PARAM_STR); // On bind une valeur à chacun de ces marqueurs nominatifs un par un - Un appel de bindParam, pour lier chaque marqueur ! 
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);



$stmt = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES (:prenom, :nom, :sexe, :service, :salaire, :date_embauche)");
$stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
$stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
$stmt->bindParam(":sexe", $sexe, PDO::PARAM_STR);
$stmt->bindParam(":service", $service, PDO::PARAM_STR);
$stmt->bindParam(":salaire", $salaire, PDO::PARAM_STR);
$stmt->bindParam(":date_embauche", $date_embauche, PDO::PARAM_STR);
$stmt->execute();
// $stmt->execute();


