<?php
session_start();
$con = mysqli_connect("localhost","root","","simplon");

if(isset($_POST['save_datetime']))
{
    // $name = $_POST['name'];
    $event_date1 = $_POST['event_dt'];
    $event_date = substr("$event_date1",0,10);
    $event_dt= substr("$event_date1",12,19);
    $name= $_POST['name'];
    // $event_time = $_POST['event_time'];

    $query = "INSERT INTO pointage (date_arrive,jour,username) VALUES ('$event_dt','$event_date','$name')";
    // $query1 = "INSERT INTO register (dayDate) VALUES ('$event_dt')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Votre heure d'arrivée à été enregistré avec succès";
        header("Location: index.php");
    }
    else
    {
        $_SESSION['status'] = "Erreur d'incertion veuillez réssayer";
        header("Location: index.php");
    }
}
$now = date("Y-m-d H:i:s");
// $now= substr("$now",0,10);
// $now=substr("$now",10);

if(isset($_POST['save_datetime_depart']))
{ 
    $name = $_POST['name'];
    // $date_now = substr("$now",0,10);

    $event_depart= $_POST['event_depart'];
    $date_now =substr("$event_depart",0,10);
    $depart = substr("$event_depart",12,19);

    // $event_depart= substr("$event_depart",12,19);
    // $date_now= substr("$event_depart",0,10);
    // $name= $_POST['name'];
    // $name= 'toto';
    // $date_now='2021-11-16';
    // $event_depart="3:42:13";

    // $event_time = $_POST['event_time'];

    // $query = "UPDATE register set eveningSignIn = $event_depart where speudo = $_POST['name'] and dayDate=now"; 

    $query = "UPDATE pointage SET date_depart='$depart' WHERE username='$name' AND jour = '$date_now'";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Votre heure d'arrivée à été enregistré avec succès";
        header("Location: depart.php");
    }
    else
    {
        $_SESSION['status'] = "Erreur d'incertion veuillez réssayer";
        header("Location: depart.php");
    }
}
?>
