<? 
session_start() ; 
 error_reporting(0);				
if(!(isset($_SESSION["CurrentUserId"]) || $_SESSION["CurrentUserId"]!=''||isset($_SESSION["username"]) || $_SESSION["username"]!=''|| $_SESSION["user_type_id"] != 1  ))
{
	  echo "<META HTTP-EQUIV='Refresh' Content='1;URL=login.html'>";
	  exit() ;
}
 
require_once("myfun.php") ;?>
<script type="text/JavaScript">

function reloadPage(url)
{
	 window.location =url;	
}

</script>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>LIBRARY OF KING SAUD UNIVERSITY</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="css/plugins/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body >
<div id="wrapper" > 
  
  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.php">Control Panel</a> </div>
    
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse" style="background-image:url(../img/header.jpg)">
      <ul class="nav navbar-nav side-nav" style="background-image:url(../img/header.jpg)">
        <li> <a href="Categories.php"><i class="fa fa-fw fa-table"></i> Categories</a> </li>
        <li> <a href="Books.php"><i class="fa fa-fw fa-edit"></i> Books</a> </li>
        <li> <a href="Requests_for_borrowing.php"><i class="fa fa-fw fa-desktop"></i> Requests for borrowing</a> </li>
        <li> <a href="Members.php"><i class="fa fa-fw fa-user"></i> Members</a> </li>
        <li> <a href="Reports.php"><i class="fa fa-fw fa-file"></i>Reports</a> </li>
        <li> <a href="redirectUser.php?action=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </nav>
  <div id="page-wrapper">
    <div class="container-fluid" style="background-image:url(../img/admin-bg.png)" > 
      
     