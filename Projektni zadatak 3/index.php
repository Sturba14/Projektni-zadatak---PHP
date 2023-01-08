<?php 
session_start();
$MySQL = mysqli_connect("localhost","root","","bazapodataka") or die('Error connecting to MySQL server.');
if(isset($_GET['menu'])) { $menu = (int)$_GET['menu']; }
if(isset($_GET['action'])) { $action = (int)$_GET['action']; }

if(!isset($_POST['_action_'])) { $_POST['_action_'] = FALSE; }
if (!isset($menu)) { $menu = 1; }
print '
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="description" content="some description">
        <meta name="keywords" content="keyword 1, keyword 2, keyword 3, keyword 4, ...">
		
		<title>Hublot</title>
	</head>
<body>
	<header>
		<div'; if ($menu > 0) { print ' class="hero-image"'; }  print '></div>
		<nav>';
		include("menu.php");
		print '
		</nav>
	</header>
	<main>';
	if (isset($_SESSION['message'])) {
		print $_SESSION['message'];
		unset($_SESSION['message']);
	}	
		if (!isset($_GET['menu']) || $_GET['menu'] == 1) { include("home.php"); }
	
		else if ($_GET['menu'] == 2) { include("news.php"); }
	
		else if ($_GET['menu'] == 3) { include("contact.php"); }
	
		else if ($_GET['menu'] == 4) { include("about.php"); }

    	else if ($_GET['menu'] == 5) { include("gallery.php"); }

    	else if ($_GET['menu'] == 6) { include("registration.php"); }

    	else if ($_GET['menu'] == 7) { include("login.php"); }
	
		print '
	</main>
	<footer>
		<p>Copyright &copy; ' . date("Y") . ' Karlo Šturbek. <a href="https://github.com/Sturba14"><img src="img/GitHub-Mark-Light-32px.png" title="Github" alt="Github"></a></p>
	</footer>
</body>
</html>';
?>