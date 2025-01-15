<?php 
$connexion= new PDO('mysql:host=localhost;dbname=users_base1','root','');
if($connexion){
    echo "conecter";
}
if (isset($_POST["valider"])) {
    echo "valider";
    if(!empty($_POST['nom'])AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['password'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);
        if(strlen($_POST['password'])<7){
            $message="Erreur :votre mot de passe est trop court."; 
               }elseif(strlen($nom)>10||strlen($prenom)>10){ 
                $message="Erreur :votre nom est trop long."; 
               
               }else{
                $testmail=$connexion->prepare("SELECT * FROM users where email=?");
                $testmail->execute(array($email));
                $controlmail=$testmail->rowCount();
                if($controlmail==0){
                $insertion =$connexion->prepare("INSERT INTO users(nom, prenom, email, password)
                VALUES (?,?,?,?)");

               // Préparer et exécuter la requête
        
               $insertion->execute(array($nom,$prenom,$email,$mdp));

               // Confirmation
               $message =" Inscription réussie !  Merci, $prenom $nom. Votre inscription a été enregistrée avec succès.";
            }else{
                $message="Erreur : Cette adresse e-mail est déjà enregistrée. Veuillez vous connecter ou essayer de réinitialiser le mot de passe";
            }
               }
    }else{
        $message="Remplissez tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body class="bg-light">
<form action="" method="post">
        <h3>Contact</h3>

        <label>Name</label><br>
        <input type="text" name="nom" class="form-control" placeholder="Nom"><br><br>

        <label>Lastname</label><br>
        <input type="text" name="prenom" class="form-control" placeholder="Prénom"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" class="form-control" placeholder="E-mail"><br>
      
        <label>Email</label><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe"><br>
    
        <button type="submit" name="valider" class="btn btn-success"> S'inscrire </button><br>
        <i style="color:red">
                              <?php
                                if(isset($message)){
                                    echo "$message";
                                }
                                ?></i>
  
    

    </form>
    <!--
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-4 bg-white m-auto rounded-top">
                    <h2 class="text-center"> Inscription </h2>
                    <p class="text-center text-muted lead"> Simple et Rapide </p>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-user"></i> </span>
                            <input type="text" name="nom" class="form-control" placeholder="Nom">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-user"></i> </span>
                            <input type="text" name="prenom" class="form-control" placeholder="Prénom">
                        </div>
                        

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
                            <input type="email" name="email" class="form-control" placeholder="E-mail">
                        </div>
                        

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-lock"></i> </span>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="valider" class="btn btn-success"> S'inscrire </button>
                            <p class="text-center text-muted ">
                                <i !style="color:red"></i>
                              <
                                if(isset($message)){
                                    echo "$message";
                                }
                                ?>
                                En cliquant sur S’inscrire, vous acceptez nos <a href=""> Conditions générales </a>, notre <a href=""> Politique de confidentialité</a> et notre <a href=""> Politique d’utilisation</a> des cookies.
                            </p>
                            <p class="text-center">
                                Avez vous déjà un compte ? <a href="connexion.html">Connexion </a> 
                            </p>
                        </div>
                    </form>
                </div>
            </div>
         </div>*/
</body>
</html>
<script src="bootstrap.bundle.js"></script>