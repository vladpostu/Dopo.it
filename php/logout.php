

<?php 

    session_start();
    $_SESSION['isLogged'] = false;
    $_SESSION['username'] = '';
    $_SESSION['id_user'] = 0;

    header('Location: ../index.php');

?>