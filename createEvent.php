<?php
    session_start();
    if(!isset($_SESSION['user_session'])){
	  header("Location: login.php");
  }   
include_once("config.php");
$sql = "SELECT userId, fullName, userPassword, userEmail FROM tbl_users WHERE userId='".$_SESSION['user_session']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset); 
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script/validation.min.js"></script>
    <script src="assets/createEvent.js"></script>
   <!-- <link href="css/style.css" rel="stylesheet" type="text/css" media="screen"/> -->
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
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
       <div class="jumbotron">
                <h4 style="text-align:center ; color: red"><strong>Create Event</strong></h4>
       </div>
                  <div class="statusMsg"></div>
        <hr> 
        <div id="fupForm">
        <div class="row">
        <div class = "col-md-5">
            <form id="myForm"  method="post"  enctype="multipart/form-data">
            <div class="form-group">
            <label for="name">EVENT</label>
            <input type="text" class="form-control" id="event" name="event" placeholder="Event Name" required />
            </div>

            <div class="form-group">
            <label for="name">LOCATION</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Event Location" required />
            </div>
        </div>
        <div class = "col-md-5">
            <div class="form-group">
            <label for="email">DATE</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Date of Event" required />
            </div>

            <div class="form-group">
            <label for="name">TIME</label>
            <input type="time" class="form-control" id="time" name="time" placeholder="Time of Event" required />
            </div>

        </div>
        </div>
        <div class="row">
        <div class="col-md-5">
            <div class="form-group">
            <label for="name">PARTICIPANTS</label>
            <input type="number" class="form-control" id="participants" name="participants" placeholder="Participants" required />
            </div>
        </div>
      
        </div>
        <hr>
          <button type="submit" id="submit" class="btn btn-primary">Create</button>
     </form>
    </div>
    </div>
    </div>
</div>
</div>  

</body>
</html>
