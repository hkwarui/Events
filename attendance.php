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
    <script src="assets/modalForm.js"></script>
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
                <h4 style="text-align:center ; color: red"><strong>Add Participant</strong></h4>
       </div>
            <div class="statusMsg"></div>
        <hr> 
        <div id="fupForm">
            <div class="row">
        <div class = "col-md-5">
            <form id="regForm"  method="post"  enctype="multipart/form-data">
            <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" required />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required />
            </div>
        </div>
        <div class = "col-md-5">
            <div class="form-group">
                <label for="phone">Phone No</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone No" required />
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select type="gender" class="form-control" id="gender" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
        </div>
        <!--start row -->
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                <label for="Event">Event</label>
                <?php
                    $sql1 = "SELECT eventID , vent FROM events" ;
                    $result = mysqli_query($conn,$sql1) or die("database error:". mysqli_error($conn));
                ?>
                <select type="text" class="form-control" id="event" name="event">
                <?php while($row=mysqli_fetch_assoc($result)){ ?>
                    <option value ="<?php echo $row['eventID']; ?>"><?php echo $row['vent'] ;?> </option>
                  <?php  }; ?>
                </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                <label for="Status">Status</label>
                 <select type="text" class="form-control" id="status" name="status">
                    <option value="Invited">Invited</option>
                    <option value ="Will Attend">Will Attend</option>
                    <option value="Not Attend">Not Attend</option>
                </select>
                </div>
            </div>
        </div>  <!-- start row -->
        <hr>
          <button type="submit" id="submit" class="btn btn-primary">Create</button>  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </form>
    </div>
    </div>
    </div>
    
    </div>
  </div>
</div>  

</body>
</html>
