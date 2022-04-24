<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Mini_chat</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
  </head>

  <body>
    <form class="box" action="" method="post" asp-antiforgery="false">
      <h1> Welcome to The Chat </h1>
      <input type="text" class="box-input" name="message" placeholder="Message *" required minlength="0" maxlength="500" />
      <input type="submit" name="submit" value="Send" class="box-button-singup" />
      <?php if (!empty($msg)) { ?>
        <p class="errorMessage"><?php echo $msg; ?></p>
      <?php } ?>
    </form>

    <?php
    require('connect_to_BDD.php');
    session_start();
    // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
    if (!isset($_SESSION["username"])) {
      header("Location: login.php");
      exit();
    }
    if (isset($_REQUEST['message'])) {
      // récupérer le pseudo et supprimer les antislashes ajoutés par le formulaire
      //$pseudo = stripslashes($_REQUEST['pseudo']);
      //mysqli_real_escape_string($conn, $pseudo);
      // récupérer le message  et supprimer les antislashes ajoutés par le formulaire
      $message = stripslashes($_REQUEST['message']);
      mysqli_real_escape_string($conn, $message);

      date_default_timezone_set('Europe/Paris');
      $today = date("y-m-d");
      $time = date("G:i:s");

      // verification des messages doublant 
      $to_verify = "SELECT * FROM `chat` WHERE message='" . $message . "'";
      $result = mysqli_query($conn, $to_verify) or die("Error");
      $word = mysqli_num_rows($result);
      if ($word != 0) {
        $msg = "le message existe déja ";
      } else {
        $query = "INSERT into `chat` (pseudo, message, date, time)
                  VALUES ('" . $_SESSION['username'] . "', '" . $message . "','" . $today . "','" . $time . "')";

        // Exécuter la requête sur la base de données
       // echo $query;
        $res = mysqli_query($conn, $query);
        //echo $query;
        if ($res) {
          echo "<div class='sucess'>
                  <h3> Votre message est envoyé avec success.</h3>
                </div>";
                header("Refresh:3");
        } else {
          echo "<div class='sucess'>
                  <h3> Votre message n'est pas envoyé avec success.</h3>
                </div>";
        }
      }
    }
    $query = 'SELECT * FROM chat ';
    $result = mysqli_query($conn, $query) or die("Error");
    $rows = mysqli_num_rows($result);
   // echo $rows;
    //afficher les 10 derniers message envoyés par desc
    $count = $rows-10;
    if ($count < 0){
      $count = 0 ; 
    } 
    $query_2 = "SELECT * FROM chat WHERE  num > '".$count."' ORDER BY num DESC";
    // supprimer les vieux 100 message
    if ($rows > 100 ){
      $query_2 ="DELETE * FROM chat where num < '".$rows."'" ;
    }
    $result_2 = mysqli_query($conn, $query_2) or die("Error");
    $rows_2 = mysqli_num_rows($result_2);
    if ($rows_2 === 0) {
      $msg = "aucun message n'est enregistré";
    } else { ?>
        <table>
          <?php
          while ($row = $result_2->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['pseudo']; ?></td>
              <td><?php echo $row['message']; ?></td>
              <td><?php echo $row['date']; ?></td>
              <td><?php echo $row['time']; ?></td>
            </tr>

          <?php }?>
        </table>
      <?php }
      
      
      ?>
       
    

  </body>

</html>
