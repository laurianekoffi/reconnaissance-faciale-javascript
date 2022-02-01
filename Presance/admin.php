<?php
//   require('db.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <title>Admin</title>
</head>
<body style="background: #0758aa;">
    <div class="container">
    <h1 class="title mt-5 text-center mb-5 " style = "color:white"> ADMINISTRATION</h1>
    <div class="col-md-5 ">
    <form action="" method="GET">
        <div class="input-group mb-3 ">
            <input type="date" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Recherche">
            <button type="submit" class="btn btn-primary">Recherche</button>
        </div>
    </form>
    </div>
     <div class="table table-bordered table-responsive" style = "color:white">
     <table id="table" class="table">
  <thead>
    <tr>
    <th scope="col">Date</th>
      <th scope="col">Nom et Prénom </th>
      <th scope="col">Heure d'arriver</th>
      <th scope="col">Heure de Départ</th>
    </tr>
  </thead>
  <tbody id="#body">
<?php 
    $con = mysqli_connect("localhost","root","","simplon");

    if(isset($_GET['search']))
    {
        $filtervalues = $_GET['search'];
        $query = "SELECT * FROM pointage WHERE CONCAT(jour,username,date_arrive,date_depart) LIKE '%$filtervalues%' ";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $items)
            {
                ?>
                <tr>
                    <td><?= $items['jour']; ?></td>
                    <td><?= $items['username']; ?></td>
                    <td><?= $items['date_arrive']; ?></td>
                    <td><?= $items['date_depart']; ?></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
                <tr>
                    <td colspan="4">Aucun Résultat trouver pour cette date</td>
                </tr>
            <?php
        }
    }
?>


      
  </tbody>
</table>
     </div>
    </div>
</body>
</html>