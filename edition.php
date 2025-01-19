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
    if(!empty($_POST['nom'])AND !empty($_POST['prenom']) AND !empty($_POST['telephone']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $pack= htmlspecialchars($_POST['pack']);
        $email= htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);
        $mdp2 = sha1($_POST['password2']);
        
            if(strlen($_POST['password'])<7){
            $message="Erreur :votre mot de passe est trop court."; 
            }elseif(strlen($nom)>10||strlen($prenom)>10){ 
                $message="Erreur :votre nom est trop long."; 
               
            }else{
                $insertion =$connexion->prepare("UPDATE `users` SET nom=?, prenom=?, telephone=?, pack=?, email=?, password=? WHERE  id=?");
               $insertion->execute(array($nom,$prenom,$telephone,$pack,$email,$mdp,$takeuser['id']));
               $message =" Inscription réussie !  Merci, $prenom $nom. Votre modificatin a été enregistrée avec succès.";
               header(("Location:profil.php?id=").$takeuser['id']);
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
<form action="" method="post" enctype="multipart/form-data">
        <h3 class="text-center">Modifier le compte</h3>

        <label>Name</label><br>
        
       
        <input type="text" name="nom" class="form-control" value=" <?=$takeuser['nom'] ?>" placeholder="Nom"><br>
      
        <label>Lastname</label><br>
        <input type="text" name="prenom" class="form-control" value=" <?=$takeuser['prenom'] ?>" placeholder="Prénom"><br>

        <label>Phone</label><br>
        <input type="number" name="telephone" class="form-control" placeholder="telephone"><br>

        <label for="">Pack  to choose:</label>
      <select   name="pack" class="form-control" placeholder="pack choisir">
      <option value="Small group">Small group </option>
      <option value="Individual">Individual</option>
     </select><br><br> 

        <label>Email</label><br>
        <input type="email" name="email" class="form-control" value=" <?=$takeuser['email'] ?>" placeholder="E-mail"><br>
      
        <label>Password</label><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe"><br>
    
        <label> New Password</label><br>
        <input type="password" name="password2" class="form-control" placeholder="Mot de passe"><br>

        <label>photo</label><br>
        <div class="input-group mb-3>
        <span class="input-group-text></span>
        <input type="file" name="file" class="form-control" >
        </div><br>
    
        <button type="submit" name="valider" class="btn btn-success"> S'inscrire </button><br>
        <i style="color:red">
                              <?php
                                if(isset($message)){
                                    echo "$message";
                                }
                                ?></i>
  
    

    </form>
    <script src="bootstrap.bundle.js"></script>
    </body>
</html>

   