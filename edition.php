<?php 
session_start();
$connexion= new PDO('mysql:host=localhost;dbname=users_base1','root','');
if(isset($_SESSION['id'])) 
{
    $reqt=$connexion->prepare("SELECT * FROM users WHERE id=?");
    $reqt->execute(array($_SESSION['id']));
    $takeuser=$reqt->fetch();
}

if($connexion){
    echo "conecter";
}
if (isset($_POST["valider"])) {
    echo "valider";
    if(!empty($_POST['nom'])AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);
        $mdp2 = sha1($_POST['password2']);
     if($mdp===$mdp2)
     {
        if(strlen($_POST['password'])<7){
            $message="Erreur :votre mot de passe est trop court."; 
               }elseif(strlen($nom)>10||strlen($prenom)>10){ 
                $message="Erreur :votre nom est trop long."; 
               
               }else{
                $insertion =$connexion->prepare("UPDATE users SET nom=?, prenom = ?, email = ? WHERE  id=?");
               $insertion->execute(array($nom,$prenom,$email,$takeuser['id']));
               $message =" Inscription réussie !  Merci, $prenom $nom. Votre modificatin a été enregistrée avec succès.";
               header(("Location:profil.php?id=").$takeuser['id']);

            }
      
     }else{
            $message="Erreur : votre mot de passe invalider.";
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
<body class="bg-light col-md-6 mx-auto p-4">
<form action="" method="post">
        <h3>Modifier le compte</h3>

        <label>Name</label><br>
        <input type="text" name="nom" class="form-control" value=" <?=$takeuser['nom'] ?>" placeholder="Nom"><br><br>

        <label>Lastname</label><br>
        <input type="text" name="prenom" class="form-control" value=" <?=$takeuser['prenom'] ?>" placeholder="Prénom"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" class="form-control" value=" <?=$takeuser['email'] ?>" placeholder="E-mail"><br>
      
        <label>Password</label><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe"><br>
    
        <label> New Password</label><br>
        <input type="password" name=" " class="form-control" placeholder="Mot de passe"><br>
    
        <button type="submit" name="valider" class="btn btn-success"> S'inscrire </button><br>
        <i style="color:red">
                              <?php
                                if(isset($message)){
                                    echo "$message";
                                }
                                ?></i>
  
    

    </form>
    </body>
</html>
<script src="bootstrap.bundle.js"></script>
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