<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <title>depart</title>
</head>
<body onload="initialize()">

<?php
  date_default_timezone_set('Africa/abidjan');
  $now = date("Y-m-d H:i:s");

?>

<div class="sucess">
    <h1>Bon Depart <?php echo $_SESSION['username']; ?>!</h1>
    <p>Enregistrer votre heur depart</p>
    <a href="deco.php">Déconnexion</a>
    </div>

<div class="card mt-5">
    <div class="card-header">
        <h4>mon heure de départ</h4>
    </div>
        <div class="card-body">

            <form action="code.php" method="POST">
                <div class="form-group mb-3">
                    <label for="">Nom et prémon</label>
                    <input type="text" name="name" class="form-control" value="<?=$_SESSION['username'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Date et heure de Départ</label>
                    <input type="datetime" name="event_depart"  value="<?=$now;?>" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <button type="submit" name="save_datetime_depart" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>

        </div>
        <div>

        <a href="deco.php">Déconnexion</a>
        </div>
    
</div>
</body>
</html>


