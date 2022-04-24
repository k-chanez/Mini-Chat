<!DOCTYPE html>
<html lang="fr">

<head>
  <title> PHP / MySQL</title>
  <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
  <?php
  require('connect_to_BDD.php');
  if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])) {
    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    //requéte SQL + mot de passe
    $to_verify = "SELECT * FROM `Users` WHERE username='" . $username . "'";
    $result = mysqli_query($conn, $to_verify) or die("mysql_error");
    $user = mysqli_num_rows($result);
    $to_verifyEmail = "SELECT * FROM `Users` WHERE email='" . $email . "'";
    $result2 = mysqli_query($conn, $to_verifyEmail) or die("mysql_error");
    $user2 = mysqli_num_rows($result2);
    $pattern = '/[A-Z]+[a-z]+[0-9]+/';
    if ($user != 0) {
      $message = "Le nom d'utilisateur existe déja";
    } elseif ($user2 != 0) {
      $message = "Cette adresse e-mail est déjà utilisée";
    } elseif (!preg_match($pattern, $password)) {
      echo "<p class='errorMessage'> le mots de passe il doit contenir entre 6 et 30 caractère
                  <br>Il doit contenir au moins 1 lettre(s) minuscule(s), 
                  majuscule(s)<br>1 caractère(s) numérique(s)
                </p>";
    } else {
      $query = "INSERT into `Users` (username, email, password)
              VALUES ('" . $username . "', '" . $email . "', '" . hash('sha256', $password) . "')";
      // Exécuter la requête sur la base de données
      $res = mysqli_query($conn, $query);
      if ($res) {
        echo "<div class='sucess'>
                    <h3>Vous êtes inscrit avec succès.</h3>
                    <p>Cliquez ici pour vous <a href='login.php'>Connecter</a></p>
                  </div>";
        exit(0);
      }
    }
  }
  ?>
  <form class="box" action="" method="post" asp-antiforgery="false">
    <h1 class="box-singup">SingUp</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur *" required minlength="4" maxlength="30" />
    <input type="email" class="box-input" name="email" placeholder="Email *" pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe *" required minlength="6" maxlength="30" />
    <input type="submit" name="submit" value="S'inscrire" class="box-button-singup" />
    <p class="box-register">Déjà inscrit(e) ? <a href="login.php"><strong>Connectez-vous ici</strong></a></p>
    <?php if (!empty($message)) { ?>
      <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
  </form>
</body>

</html>