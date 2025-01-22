
<?php
session_start();
$connexion= new PDO('mysql:host=localhost;dbname=users_base1','root','');


if(isset($_GET['id']) && $_GET['id']>0){
    $takeid=intval($_GET['id']);
    $reqt=$connexion->prepare("SELECT * FROM users WHERE id=?");
    $reqt->execute(array($takeid));
    $takeinfo=$reqt->fetch();  
}

if(isset($_SESSION['id'])) 
{
    $reqt=$connexion->prepare("SELECT * FROM users WHERE id=?");
    $reqt->execute(array($_SESSION['id']));
    $takeuser=$reqt->fetch();
}

if (isset($_POST["valider"])) {
    echo "valider";
 if(!empty($_POST['nom'])AND !empty($_POST['prenom']) AND !empty($_POST['telephone']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
  {
     if ($mdp !== $mdp2)
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $pack= htmlspecialchars($_POST['pack']);
        $email= htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);
        $mdp2 = sha1($_POST['password2']);

        $message = "Les mots de passe ne correspondent pas.";
    } else {
            if(strlen($_POST['password'])<7){
            $message="Erreur :votre mot de passe est trop court."; 
            }elseif(strlen($nom)>10||strlen($prenom)>10){ 
                $message="Erreur :votre nom est trop long."; 
               
            }else{
    
                  $insertion = $connexion->prepare("UPDATE `users` SET nom=?, prenom=?, telephone=?, pack=?, email=?, password=? WHERE id=?");
                  $insertion->execute(array($nom, $prenom, $telephone, $pack, $email, $mdp, $takeuser['id']));
                  $message = "Modification réussie!";
                  header("Location: profil.php?id=" . $takeuser['id']);
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
    <title>profil</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
</head>
<body class="bg-light ">

    <div class="container ">

    <script>
    function getFocus(){
    document.getElementById("prenom").focus();
}

</script>

        <div class="row d-flex justify-content-center  ">
            <div class="col-md-12 mt-3 pt-3 ">
                <div class="row z-depth-3">
                    <div class="col-sm-6 bg-white">
                        
                        <div class="card-block text-center text-dark">

                        <?php if (!empty($takeinfo['photo'])) { ?>
                                <img src="imge/<?=$takeinfo['photo'] ?>" class="img-fluid img-thumbnail" alt="">
                            <?php } else { ?>  


                        
                            <i class="fas fa-user-tie fa-7x mt-5"></i>
                            <?php }?>
                            <h2 class="font-weight-bold   mt-4">Bonjour <?=$takeinfo['nom'] ?></h2><br><br>
                        


                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-5">
                            <p class="font-weight-bold">Prenom:</p>
                            <p class="font-weight-bold">Email :</p>
                            <p class="font-weight-bold">Tel :</p>
                            
                            </div>
                            <div class="col-sm-5">
                            <p class="text-muted"><?=$takeinfo['prenom'] ?></p>
                            <p class="text-muted"><?=$takeinfo['telephone'] ?></p>
                            <p class="text-muted"><?=$takeinfo['email'] ?></p>
                            </div>
                        
                        </div>

                         <div class="row d-flex justify-content-center">
                             <div class="col-sm-5">
                            <p > ||Edite|| </p>
                            <a href="" type="button" onclick="getFocus()"><i class="far fa-edit fa-2x mb-2"></i></a>

                        </div>
                            <div class="col-sm-5">
                            <p> ||Déconicte|| </p>
                            <a href="deconnexion.php"><i class="fa fa-power-off mt-2 fa-2x"></i></a>
                            </div>
                         </div>

                        </div>

                    </div>
                    
        <div class="col-md-6 mx-auto p-4 bg-red rounded">
            <h2 class="text-center mb-4">Modifier le compte</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"  enctype="multipart/form-data" class="row  d-flex justify-content-center bs-warning">

                <!-- Informations personnelles -->
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="texte"   id="nom" name="nom" value=" <?=$takeuser['nom'] ?>"  class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom"  value=" <?=$takeuser['prenom'] ?>" class="form-control" required>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                    <label for="telephone" class="form-label">Telephone :</label>
                    <input type="tel" id="telephone" name="telephone" value="<?= $takeuser['telephone'] ?>" class="form-control">

                </div>
                <!-- Cours choisi -->
                <div class="col-md-6">
                    
                    <label for="cours" class="form-label">Pack  to choose:</label>
                    <select id="cours" name="pack" class="form-select" required>
                    <option value="Small group" <?= ($takeuser['pack'] == 'Small group') ? 'selected' : '' ?>>Small group</option>
                    <option value="Individual" <?= ($takeuser['pack'] == 'Individual') ? 'selected' : '' ?>>Individual</option>
                   </select>

                </div>
                </div>
                
                <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                <label for="email" class="form-label">Email :</label><br>
                
                <input type="email" id="email" name="email"  value=" <?=$takeuser['email'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                <label>Password</label><br>
                <input type="password" name="password" class="form-control" placeholder="Mot de passe"><br>
                </div>
                <div class="col-md-6">
                <label> New Password</label><br>
                <input type="password" name="password2" class="form-control" placeholder="Mot de passe"><br>
                </div>
                
                <!-- Bouton de soumission -->
                <div class="col-md-6">
                    <button type="submit" name="valider" class="btn btn-primary w-100">S'inscrire</button>
                </div></div>
            </form>
        </div>

                </div>

            </div>

        </div>
    </div>
  
</body>
</html>

<script src="js/bootstrap.bundle.js"></script>