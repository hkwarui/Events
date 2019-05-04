
<?php 
    include_once "config.php";
if(!empty($_POST['fullname']) || !empty($_POST['email']) || !empty($_POST['phone']) || !empty($_POST['gender']) || !empty($_POST['event']) || !empty($status = $_POST['status']) ){
    $event = $_POST['event'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    $insert = $DBcon->query("INSERT attendance (eventId, regName, regEmail, regPhone, regGender, regStatus) VALUES ('".$event."','".$fullname."','".$email."','".$phone."','".$gender."','".$status."')");
    
    echo $insert?'ok':'err';
}

?>

