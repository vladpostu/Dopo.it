

<?php 

    session_start();

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'dopo';

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_image = $_POST['product_image'];

    $_SESSION['product_image'] = $product_image;
    
    switch($product_category) {
        case 'elettronica': 
            $product_category = 1;
            break;

        case 'casa': 
            $product_category = 2;
            break;

        case 'libri': 
            $product_category = 3;
            break;

        case 'piante': 
            $product_category = 4;
            break;

        case 'altro': 
            $product_category = 5;
            break;
    }


    try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insert_ad = "INSERT INTO ads (name, price, image, category)
                      VALUES ('$product_name', $product_price, '$product_image', $product_category)";

        $getAdId = "SELECT id_ad FROM ads ORDER BY id_ad DESC LIMIT 1";

        $conn->exec($insert_ad);

        $stmt = $conn->query($getAdId);
        $result = $stmt->fetch();
        $id_ad = $result[0];

        $_SESSION['id_ad'] = $result[0];

        $id_user = $_SESSION['id_user'];
        echo $id_user;

        $insert_ad_user = "INSERT INTO users_ad(id_user, id_ad)
                           VALUES($id_user, $id_ad)";

        $conn->exec($insert_ad_user);

    } catch (PDOException $e) {
        echo $e->getMessage();    
    }

    header('Location: ../index.php')
?>