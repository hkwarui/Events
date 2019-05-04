<?php
    session_start();
    if(!isset($_SESSION['user_session'])){
	  header("Location: login.php");
  }   

include_once("config.php");
$sql = "SELECT userId, fullName, userPassword, userEmail FROM tbl_users WHERE userId='".$_SESSION['user_session']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row1 = mysqli_fetch_assoc($resultset);
$uid = $_SESSION['user_session'];
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
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $row1['fullName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
        </ul>
    </div>
</nav>

    <div class="container">
        <div class="jumbotron">
            <h5 style="color:red; text-align:center"><b>EVENTS</b></h5>
        </div>
        <div class="row">
            <p><button type="button" class="btn btn-primary">Today</button>
                <button type="button" class="btn btn-default">ThisWeek</button>
                <button type="button" class="btn btn-default">This Month</button>
                <button onclick="window.location.href='createEvent.php'" style="float:right" type="button" class="btn btn-danger">Create Event </button>
            </p>

        </div>
        <div class="row">
        <table class="table table-hover">
          <thead style="background-color:#f3f3f3">
          <tr>
            <th>Event</th>
            <th>Location</th>
            <th>Date</th>
            <th>Time</th>
            <th>Capacity</th>
            <th>Action</th>
          </tr>
        </thead>

         <?php 
           $query="SELECT * FROM events ORDER BY eDate"; 
           $result =  mysqli_query($conn, $query) or die('database error:'. mysqli_error($conn)) ;?>
        <tbody>
      <tr>
         <?php while($row=mysqli_fetch_assoc($result)) {; ?>

          <td><b><?php  echo $row['vent'];?></b></td>
          <td><?php  echo $row['eLocation'];?></td>
          <td><?php echo date('jS M Y', strtotime($row['eDate'])) ;?></td>
          <td><?php  echo date('Hi', strtotime($row['eTime']));?>hrs</td>
          <td><?php  echo $row['participants'];?></td>
          <?php echo '<td><a href = "registration.php?id=', urlencode($row['eventID']), '"><span  style="color:grey" class="glyphicon glyphicon-eye-open"></span> | <span class="glyphicon glyphicon-edit"></span> | <span style="color:red" class="glyphicon glyphicon-trash"></span></a></td>' ; ?>
        </tr>
        <?php } ?>

        </tbody>

            </table>
        </div>
    </div>
</body>

</html>