<?php

    session_start();

    $username_login = $_POST['username_login'];
    $password_login = $_POST['password_login'];

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'dopo';


    try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $login = "SELECT * FROM accounts 
                  INNER JOIN users ON accounts.id_account = users.id_user
                  WHERE username = '$username_login'";

        $stmt = $conn->query($login);

        while ($row = $stmt->fetch()) {
            if(password_verify($password_login, $row['password'])) {
                $_SESSION['isLogged'] = true;
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['id_user'] = $row['id_account']; 
                $_SESSION['failedToLog'] = false; 
            } else {
                $_SESSION['failedToLog'] = true;
            }
        }
        

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    header('Location: ../index.php');

?>