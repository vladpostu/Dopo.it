

<?php 
    $id_ad = $_GET['id_ad'];
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'dopo';

    try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $deleteProd = "DELETE FROM users_ad WHERE id_ad = $id_ad";
        $deleteAd = "DELETE FROM ads WHERE id_ad = $id_ad";
        $conn->exec($deleteProd);
        $conn->exec($deleteAd);

    } catch (PDOException $e) {
        $e->getMessage();
    }

    header('Location: ../index.php');
?>