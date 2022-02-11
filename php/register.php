
<?php session_start(); ?>

<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'dopo';

    $sql = "";

    $username_user = $_POST['username'];
    $password_user = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $city = $_POST['city'];
    $cellphone = $_POST['cellphone'];
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $insertUser = "";
        $getIdUser = "";
        $insertAccount = "";
        $updateIdAccount = "";
       

        //insert the user in the users table
        $insertUser =      "INSERT INTO users (firstname, surname, city, cellphone)
                            VALUES('$firstname', '$surname', '$city', '$cellphone')";
                             
        //get the id_user with a query from users 
        $getIdUser =       "SELECT * FROM users ORDER BY id_user DESC LIMIT 1";

        //insert values of account in accounts table 
        $insertAccount =   "INSERT INTO accounts (username, password)
                            VALUES('$username_user', '$password_user')";

        $conn->exec($insertUser);
        $conn->exec($insertAccount);
        
        $stmt = $conn->query($getIdUser);
        $idUser = $stmt->fetch();
        $idUser = $idUser[0];

        $updateIdAccount = "UPDATE accounts
                            SET id_account = $idUser
                            WHERE id_account IS NULL";

        $conn->exec($updateIdAccount);
        
        $_SESSION['isLogged'] = true;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['id_user'] = $idUser;

    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;

    header("Location: ../index.php");
?>