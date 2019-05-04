<?php
    session_start();
    if(!isset($_SESSION['user_session'])){
	  header("Location: login.php");
  }  
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }

include_once("config.php");
$uid = $_SESSION['user_session'];
$sql = "SELECT * FROM events WHERE eventID =$id";
$sql1 ="SELECT * FROM tbl_users WHERE userId = '$uid'";
$result = mysqli_query($conn, $sql1) or die("database error:".mysqli_error($conn));
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row =mysqli_fetch_assoc($result);
$row1 = mysqli_fetch_assoc($resultset);

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Attendance MS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>
    
    <!-- <link href="css/style.css" rel="stylesheet"type="text/css" media="screen"/> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js"></script>
    <script src="assets/modalForm.js"></script>
 
  </head>

<body>

<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="main.php" class="navbar-brand"><b style="color:red;">Attendance MS</b></a>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $row['fullName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
        </ul>
    </div>
</nav>

    <div class="container">
        <div class="jumbotron" style="color:red">
                <h3><b><?php  echo strtoupper($row1['vent']);?> @ <?php echo strtoupper($row1['eLocation']); ?>  - <?php echo date('d/M/Y', strtotime($row1['eDate'])) ;?>: <?php  echo date('Hi', strtotime($row1['eTime'])) ;?>Hrs</b></h3> 
        </div>
       
        <div class="row">
           <p> 
               <span class="badge badge-light"><b><?php  echo $row1['participants']; ?> Participants</b></span> <button  onclick="window.location.href='attendance.php'" style="float:right; margin:5px" type="button" class="btn btn-danger" > Register </button>
           </p>
        </div>

        <div class="row">
        <table class="table table-hover">
          <thead style="background-color:#f3f3f3">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Gender</th>
            <th>Attendance</th>
            <th>Action</th>
          </tr>
        </thead>

         <?php 
           $query="SELECT * FROM attendance WHERE eventId = $id"; 
           $result1 =  mysqli_query($conn, $query) or die('database error:'. mysqli_error($conn)) ;?>
        <tbody>
      <tr>
         <?php while($row2=mysqli_fetch_assoc($result1)) {; ?>

          <td><b><?php  echo $row2['regName'];?></b></td>
          <td><?php  echo $row2['regEmail'];?></td>
          <td><?php echo $row2['regPhone'] ;?></td>
          <td><?php  echo $row2['regGender'];?></td>
          <td><?php  echo $row2['regStatus'];?></td>
          <td>Edit | cancel</td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Register Participant</h4>
      </div>
      <div class="modal-body">
        
    </div>
    </div>

  </div>
</div>

<script>
$(document).ready(function (e) {
    $("#regForm").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'modal.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled", "disabled");
                $('#regForm').css("opacity", ".5");
            },
            success: function (msg) {
                $('.statusMsg').html('');
                if (msg == 'ok') {
                    $('#regForm')[0].reset();
                    $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');

                } else {
                    $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                }
                $('#regForm').css("opacity", "");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
});

</script>

</body>
</html>