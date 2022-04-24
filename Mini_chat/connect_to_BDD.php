<!DOCTYPE html>
<html lang="fr">
  <head>
    <title> PHP / MySQL</title>
  </head>
  <body>
    <?php
      define('SERVER_NAME_01', 'localhost');
      define('USERNAME_02' ,'vQqLHWYs');
      define('PASSWORD_03','8MZk3o0ZOJ2vQqLHWYsv0FvfyltG3sRl');
      define('DB_NAME_04' , 'Users_NXM8');
      //On établit la connexion
      $conn = new mysqli(SERVER_NAME_01, USERNAME_02, PASSWORD_03,DB_NAME_04);
      //On vérifie la connexion
      if($conn->connect_error){
          die('Erreur : ' .$conn->connect_error); 
      }
     
    ?>
  </body>
</html>
