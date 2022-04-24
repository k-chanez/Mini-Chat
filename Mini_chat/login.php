<!DOCTYPE html>
<html lang="fr">

<head>
  <title> PHP / MySQL</title>
  <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
  <?php
  require('connect_to_BDD.php');
  session_start();

  if (isset($_POST['username'], $_POST['password'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `Users` WHERE username= '" . $username . "' and password='" . hash('sha256', $password) . "'";
    $result = mysqli_query($conn, $query) or die("mysql_error");
    $rows = mysqli_num_rows($result);
    echo "<script>console.log('Debug Objects: " . $rows . "' );</script>";

    if ($rows == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      header("Location: index.php");
      die();
    } else {
      $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
  }
  ?>
  <?php
  header('X-Frame-Options: DENY', 'X-Content-Type-Options: nosniff');
  header_remove('x-powered-by');
  header("Set-Cookie: name=value; HttpOnly");
  ?>

  <form class="box" action="" method="post">
    <h1 class="box-login">Log In</h1>
    <input type="text" class="box-input" name="username" placeholder="User *">
    <input type="password" class="box-input" name="password" placeholder="PassWord *">
    <input type="submit" value="Connexion " name="submit" class="box-button-login">
    <p class="box-register"> <a href="singup.php"><strong>Sign Up</strong></a></p>
    <?php if (!empty($message)) { ?>
      <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
  </form>
</body>

</html>