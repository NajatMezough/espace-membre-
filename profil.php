
<?php
session_start();
$connexion= new PDO('mysql:host=localhost;dbname=users_base1','root','');

if(isset($_GET['id']) && $_GET['id']>0){
    $takeid=intval($_GET['id']);
    $reqt=$connexion->prepare("SELECT * FROM users WHERE id=?");
    $reqt->execute(array($takeid));
    $takeinfo=$reqt->fetch();
 
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
        <div class="row d-flex justify-content-center  ">
            <div class="col-md-12 mt-3 pt-5 ">
                <div class="row z-depth-3">
                    <div class="col-sm-6 bg-white">
                        
                        <div class="card-block text-center text-dark">
                            <i class="fa-3x mt-4"><img width="82px" src="https://plus.unsplash.com/premium_photo-1689568126014-06fea9d5d341?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" href="" ></i>
                            <h2 class="font-weight-bold  fs-5 mt-5">Bonjour <?=$takeinfo['nom'] ?></h2>
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-5">
                            <p class="font-weight-bold">Tel :</p>
                            <p class="font-weight-bold">Email :</p>
                            </div>
                            <div class="col-sm-5">
                            <p class="text-muted"><?=$takeinfo['email'] ?></p>
                            <p class="text-muted"><?=$takeinfo['prenom'] ?></p>
                            </div>
                        
                        </div>

                         <div class="row d-flex justify-content-center">
                             <div class="col-sm-5">
                            <p> ||Edite|| </p>
                            <i class="far fa-edit fa-2x mb-2"></i>
                            </div>
                            <div class="col-sm-5">
                            <p> ||Déconicte|| </p>
                            <i class="fa fa-power-off mt-2 fa-2x"></i>
                            </div>
                         </div>

                        </div>

                    </div>
                    
        <div class="col-md-6 mx-auto p-4 bg-red rounded">
            <h2 class="text-center mb-4">Modifier le compte</h2>
            <form action="traitement.php" method="POST" class="row  d-flex justify-content-center bs-warning">
                <!-- Informations personnelles -->
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" required>
                </div>
                <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <label for="email" class="form-label">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Téléphone :</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control">
                </div>
                </div>

                <!-- Cours choisi -->
                <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <label for="cours" class="form-label">Cours choisi :</label>
                    <select id="cours" name="cours" class="form-select" required>
                        <option value="">--Sélectionnez un cours--</option>
                        <option value="developpement_web">Développement Web</option>
                        <option value="design_graphique">Design Graphique</option>
                        <option value="marketing_digital">Marketing Digital</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="niveau" class="form-label">Niveau :</label>
                    <select id="niveau" name="niveau" class="form-select" required>
                        <option value="">--Sélectionnez le niveau--</option>
                        <option value="debutant">Débutant</option>
                        <option value="intermediaire">Intermédiaire</option>
                        <option value="avance">Avancé</option>
                    </select>
                </div>
               </div>

                <!-- Bouton de soumission -->
                <div class="col-md-12">
                    <button type="submit" name="valider" class="btn btn-primary w-100">S'inscrire</button>
                </div>
            </form>
        </div>
    
                <!--<div class="col-sm-6 bg-white">
                    <h3 class="mt-3"> Info </h3>
                    <hr class="badge-dark mt-0 w-250 ">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Email :</p>
                            <p class="text-muted">Prince47@codelab.com</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Tel :</p>
                            <p class="text-muted">+860 785-694</p>
                        </div>
                    </div>
                    <h4 class="mt-3"> Projets </h4>
                    <hr class="bg-dark">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Nom :</p>
                            <p class="text-muted">Prince47</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold"> Groupe </p>
                            <p class="text-muted"> Codelab</p>
                        </div>
                    </div>
                    <hr class="bg-dark">
                    
                    


                </div>-->


                </div>

            </div>

        </div>
    </div>
    





</body>
</html>
<script src="js/bootstrap.bundle.js"></script>