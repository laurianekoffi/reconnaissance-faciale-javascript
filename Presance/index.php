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
<html>
<head>

  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="main.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0px; padding: 0px ;}
      #map_canvas { height: 100% ; width:150%;}
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>   
    <script type="text/javascript">

        var previousPosition = null;
    
        function initialize() {
            map = new google.maps.Map(document.getElementById("map_canvas"), {
                  zoom: 15,
                  center: new google.maps.LatLng(5.3510144, -4.0075264),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                });     
        }
          
        if (navigator.geolocation)
            var watchId = navigator.geolocation.watchPosition(successCallback, null, {enableHighAccuracy:true});
        else
            alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
            
        function successCallback(position){
            map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude), 
                map: map
            });  
            if (previousPosition){
                var newLineCoordinates = [
                     new google.maps.LatLng(previousPosition.coords.latitude, previousPosition.coords.longitude),
                     new google.maps.LatLng(position.coords.latitude, position.coords.longitude)];
                
                var newLine = new google.maps.Polyline({
                    path: newLineCoordinates,          
                    strokeColor: "#FF0000",
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });
                newLine.setMap(map);
            }
            previousPosition = position;
        };      
    </script>
  </head>
  <body onload="initialize()">
  <?php
  $ip_address=file_get_contents('http://checkip.dyndns.com/');
  $ip_address = str_replace("Current IP Address: ","",$ip_address);
  date_default_timezone_set('Africa/abidjan');
  $now = date("Y-m-d H:i:s");

  ?>
    <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="depart.php">Déconnexion</a>
    </div>

    <br><br><br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4> mon heure d'arrivé</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Nom et prémon</label>
                                <input type="text" name="name" class="form-control" value="<?=$_SESSION['username'];?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date et Heure d'arriver</label>
                                
                                <input type="datetime" name="event_dt"  value="<?=$now;?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_datetime"  class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- <div class="card mt-5">
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

                    </div> -->
                </div>
                </div>
                </div>
                </div>
              



    <br><br><br><br><br>
     
    <div id="map_canvas"></div>






</script> 
</body>
</html>




