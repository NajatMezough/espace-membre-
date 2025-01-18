<?php 
$connexion= new PDO('mysql:host=localhost;dbname=users_base1','root','');

if($connexion){
    echo "conecter";
}
if (isset($_POST["valider"])) {
    echo "valider";
    if(!empty($_POST['nom'])AND !empty($_POST['prenom']) AND !empty($_POST['telephone']) AND !empty($_POST['pack']) AND !empty($_POST['email']) AND !empty($_POST['password'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $pack = htmlspecialchars($_POST['pack']);
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
                $insertion =$connexion->prepare("INSERT INTO users(nom,prenom,telephone,pack,email,password,photo)
                VALUES (?,?,?,?,?,?,?)");
               $insertion->execute(array($nom,$prenom,$telephone,$pack,$email,$mdp,''));
               header("Location: connexion.php");

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
<body class="bg-light col-md-6 mx-auto p-4">
<form action="" method="post">
        <h3>registration</h3>

        <label>Name</label><br>
        <input type="text" name="nom" class="form-control" placeholder="Nom"><br>

        <label>Lastname</label><br>
        <input type="text" name="prenom" class="form-control" placeholder="Prénom"><br>

        <label>Phone</label><br>
        <input type="number" name="telephone" class="form-control" placeholder="telephone"><br>

     
      <label for="">Pack  to choose:</label>
      <select  name="pack" class="form-control" placeholder="pack choisir">
      <option value="Small group">Small group </option>
      <option value="Individual">Individual</option>
     </select><br><br> 
     
        <label>Email</label><br>
        <input type="email" name="email" class="form-control" placeholder="E-mail"><br>
      
        <label>password</label><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe"><br>

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
   
</body>
</html>
<script src="bootstrap.bundle.js"></script>