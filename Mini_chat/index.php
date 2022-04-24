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
	<html lang="fr">
		<head>
			<title> PHP / MySQL</title>
			<link rel="stylesheet" type="text/css" href="/style/style.css" />
			<?php 
		header('X-Frame-Options: DENY'); 
		header_remove('x-powered-by');
		header( "Set-Cookie: name=value; HttpOnly" );
			?>
		</head>
		<body>
			<div class="sucess">
			<h1>Bienvenue <?php echo $_SESSION['username']; ?><span class="emoji wave" role="img" aria-label="hand wave"></span></h1>
			<p> Cliquez ici pour <a href="chat.php" rel=noopener> Accéder au Chat  </a></p> 
			<a href="logout.php">Déconnexion</a>
			</div>
		</body>
</html>