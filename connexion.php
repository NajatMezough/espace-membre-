<?php
session_start();
$connexion= new PDO('mysql:host=localhost;dbname=users_base1','root','');
if($connexion)
{
    echo "conecter";
}
if (isset($_POST["valider"]))
 {
    echo "valider";
    if(!empty($_POST['email'])AND !empty($_POST['password']))
    {
        $email = htmlspecialchars($_POST['email']);
        $password = sha1($_POST['password']);
        $reqt=$connexion->prepare("SELECT * FROM users WHERE  email = ? AND password=?");
        $reqt->execute(array($email,$password));
        $controlmdp=$reqt->rowCount();
        if($controlmdp==1)
        {
            $message="Ereer: votrea compt a bien ete trove.";
            $info=$reqt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id']=$info['id'];
            $_SESSION['nom']=$info['nom'];
            $_SESSION['prenom']=$info['prenom'];
            $_SESSION['email']=$info['email'];
            header("Location:profil.php?id=".$_SESSION['id']);
             }     
    }else{
        $message="Ereer: Désile mous me trouvons pas ce compte.";
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body class="bg-light">
<form action="" method="post">
        <h3>Contact</h3>

        <label>Email</label><br>
        <input type="email" name="email" class="form-control" placeholder="E-mail"><br>
      
        <label>Email</label><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe"><br>
    
        <button type="submit" name="valider" class="btn btn-success"> S'inscrire </button><br>
        <i style="color:red">
                              <?php
                                if(isset($message)){
                                    echo $message."<br>";
                                }
                                ?></i>
  
    

    </form>

        <!--<div class="container">
            <div class="row mt-5">
                <div class="col-lg-4 bg-white m-auto rounded-top">
                    <h2 class="text-center"> Connexion </h2>
                    <p class="text-center text-muted lead"> Se connecter à WWW</p>
                    <form action="">

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
                            <input type="text" class="form-control" placeholder="E-mail">
                        </div>
                        

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-lock"></i> </span>
                            <input type="text" class="form-control" placeholder="Mot de passe">
                        </div>
                        
                        <div class="d-grid">
                            <button type="button" class="btn btn-success"> Se Connecter </button>
                           
                            <p class="text-center">
                                N'avez vous pas de compte ? <a href="inscription.html">Inscription </a> 
                            </p>
                        </div>
                    </form>
                </div>
            </div>
         </div>
</body>
</html>
<script src="bootstrap.bundle.js"></script>