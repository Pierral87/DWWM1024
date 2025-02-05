<?php 
require_once "inc/config.inc.php";   // Elements de configs de notre site
require_once "inc/functions.inc.php"; // Les fonctions qu'on appelera peut être 


// CODE ICI 
// CODE PROPRE A CHAQUE PAGE 

$content = ""; 

$content .= '<div class="alert alert-danger" role="alert">
  Attention mot de passe trop court !
</div>';

$content .= '<div class="alert alert-danger" role="alert">
  Attention le format d\'email n\'est pas valide !
</div>';


require_once "inc/header.inc.php";
require_once "inc/nav.inc.php";
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
<div class="container">
<h1 class="mt-5">Connexion</h1>
<p class="lead">Connectez vous !</p>
<?= $content ?>
<form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</main>
<?php 
require_once "inc/footer.inc.php";