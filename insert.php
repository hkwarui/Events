<?php
include_once 'config.php';
if(!empty($_POST['event']) || !empty($_POST['location']) || !empty($_POST['date']) || !empty($_POST['time']) || !empty($_POST['participants']) ){

    $event = $_POST['event'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $participants = $_POST['participants'];
        
    //insert form data in the database
    $insert = $DBcon->query("INSERT events (vent, eLocation, eDate,eTime, participants) VALUES ('".$event."','".$location."','".$date."','".$time."','".$participants."')");
    
    echo $insert?'ok':'err';
}

?>