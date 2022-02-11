
<?php 
    session_start(); 

    //hide warning errors
    error_reporting(E_ERROR | E_PARSE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300&family=Orbitron:wght@700&display=swap"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dopo.it</title>
</head>
<body>
    <?php 
        $isLogged = $_SESSION['isLogged'];
        $username = $_SESSION['username'];
        $firstname = $_SESSION['firstname'];
        $surname = $_SESSION['surname'];
        $failedToLog = $_SESSION['failedToLog'];
        $_SESSION['prodToDelete'] = 2;
        $prodToDelete = 4;

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'dopo';

        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $products = "SELECT * FROM ads
                         INNER JOIN users_ad ON ads.id_ad = users_ad.id_ad
                         INNER JOIN users ON users_ad.id_user = users.id_user;";
            $users_ad = "SELECT * from users_ad";
            $result = $conn->query($products);
            $resultUsers = $conn->query($users_ad);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    ?>

    <div class="gray-layer"></div>
    <div id="navbar">
        <nav>
            <div id="logo_container">
                <img src="./images/Logo.png" id="logo" />
            </div>
            <div class="nav-elements">
                <?php 
                    if($isLogged == false) { ?>
                        <div class="nav-element user-select-none" id="login_button">Login</div>
                        <button class="nav-element btn btn-primary" id="register_button">
                        <img src="./images/icons/user_icon_black.png" alt="">
                        <span>Registrati</span>
                        </button>
                    <?php
                    } else { ?> 
                        <div class="d-none">
                            <div class="nav-element user-select-none" id="login_button">Login</div>
                            <button class="nav-element btn btn-primary" id="register_button">
                            <img src="./images/icons/user_icon_black.png" alt="">
                            <span>Registrati</span>
                        </button>
                        </div>
                        <span>Ciao <?php echo $firstname;?>!</span> 
                        <form action="./php/logout.php">
                            <button type='submit' class='ms-4 btn btn-danger' id='logout' style='color: red;'? >Logout</b>
                        </form>
                    <?php }?>
            </div>
        </nav>
    </div>

    <?php if($failedToLog == true) {?>
        <div class="alert alert-warning alert-dismissible fade show mt-3 text-center" role="alert">
            <strong style='color: #605c33;'>Autenticazione fallita!</strong> Riprova a loggarti o registrati.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }?>

    <div id="container">
        <h1 id="title">Dopo.it</h1>
        <h2>Il tuo nuovo store online <br> preferito, per davvero.</h2>
        <div id="input_container">
            <div id="input">
                <input type="text" placeholder="Cerca un prodotto..." id='input_search'>
                <?php if($isLogged == false) {?>
                    <button type="button" class="btn btn-primary insert_ad" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Devi essere registrato o loggato per inserire un annuncio">
                        <img src="./images/icons/plus.png" alt="">
                        <span class="fw-bold">Inserisci annuncio</span>
                    </button>
                <?php } else {?>
                    <button type="button" class="btn btn-primary insert_ad" id='insert_ad'>
                        <img src="./images/icons/plus.png" alt="">
                        <span class="fw-bold">Inserisci annuncio</span>
                    </button>
                <?php } ?>
            </div>

            <div class="insert_ad_container">
                <div class="close-button" id="insert_ad_close_button">+</div>
                <form id="insert_ad_box" method='POST' action='./php/insert_ad.php'>
                    <h2>Inserisci annuncio</h2>
                    <div class="insert-space">
                        <label for="product_name">Nome del prodotto</label>
                        <input type="text" placeholder='Pianta decorativa' name='product_name' />
                    </div>
                    <div class="insert-space">
                        <label for="product_price">Prezzo</label>
                        <input type="number" placeholder='30' name='product_price' />
                    </div>
                    <div class="insert-space">
                        <label for="product_category">Categoria</label>
                        <select name="product_category" id="">
                            <option value="elettronica">Elettronica</option>
                            <option value="casa">Casa</option>
                            <option value='libri'>Libri</option>
                            <option value="piante">Piante</option>
                            <option value="altro">Altro</option>
                        </select>
                    </div>
                    <div class="insert-space">
                        <label for="product_image">Immagine</label>
                        <input type="text" placeholder="Inserire il link dell'image" name='product_image' />
                    </div>
                    <button type='submit' class='btn btn-primary' id='insert_ad_button'>Inserisci annuncio</button>
                </form>
            </div>

        </div>
        <div class="mt-2 fw-light">Risultati ricerca "<span class="fw-bold" id="search_result"></span>"</div>
        <div id="categories" class="mt-3">
            <div class="category category-selected">Tutte</div>
            <div class="category">Elettronica</div>
            <div class="category">Casa</div>
            <div class="category">Libri</div>
            <div class="category">Piante</div>
            <div class="category">Altro</div>
            <div class="category">Miei annunci</div>
        </div>
        <div id="products" class="mt-5">
            <?php 
                try {
                    while($row = $result->fetch()) {
                        echo "<div class='product'  price='".$row['price']."' img_src='".$row['image']."' title='".$row['name']."' firstname='".$row['firstname']."' surname='".$row['surname']."' city='".$row['city']."' cellphone='".$row['cellphone']."' isUserProd='' category='".$row['category']."'>";
                            echo "<img src=".$row['image']." />";
                            echo "<div class='text-center fw-bold mt-2'>" .$row['name'] . "</div>";
                            echo "<div class='buy mt-3 fw-bold'>";
                                echo "<div class='price'>€".$row['price']."</div>";
                                while($row_ad = $resultUsers->fetch()) {
                                    if($row_ad['id_user'] == $_SESSION['id_user'] and $row_ad['id_ad'] == $row['id_ad']) {
                                        ?>
                                        <form action='./php/delete.php' method='GET'>
                                            <button type='submit' name='id_ad' value="<?php echo $row['id_ad']?>" onclick="" isUserProd='true' class='btn btn-danger buy-button delete-prod'>Elimina</button>
                                        </form>
                                        <?php 
                                        break;
                                    } else {
                                        ?>
                                        <button type='button' isUserProd='false' onclick='' class='btn btn-primary buy-button'>Compra</button>
                                        <?php
                                        break;
                                    }
                                }
                            echo "</div>";
                        echo "</div>";
                    }

                } catch (PDOException $e) {
                    $e->getMessage();
                }
            ?>
            <!-- <div class="product">
                <img src="./images/products/plants/plant1.png" alt="">
                <div class="text-center fw-bold">Pianta decorativa</div>
                <div class="buy mt-3 fw-bold">
                    <div class="price">€20</div>
                    <button type="button" class="btn btn-primary">Compra</button>
                </div>
            </div> -->
        </div>
    </div>

    <div class="view_prod">
        <div class="close-button" id="view_prod_close">+</div>
        <h3 id="prod_title">Lorem, ipsum dolor.</h3>
        <div id='view_prod_cont'>
            <div class='p-r'>
                <img id='prod_img' src="./images/products/plants/plant1.png" alt="" />
            </div>
            <div class='flex-col'>
                <div>
                    <label for="">Nome Venditore</label> <br>
                    <strong id='prod_name'>Vlad Postu</strong> <br>
                </div>
                <div>
                    <label for="">Numero telefono</label> <br>
                    <strong id='prod_cell'>3245806105</strong> <br>
                </div>
                <div>
                    <label for="">Città</label> <br>
                    <strong id='prod_city'>Spinea</strong>
                </div>
                <div>
                    <label for="">Prezzo</label> <br>
                    <strong id='prod_price'>€20</strong>
                </div>
            </div>
        </div>
        
    </div>

    <div class="login entry">
        <div class="entry-container">
            <div class="close-button" id="login_close_button">+</div>
            <div class="fw-bold fs-3 text-center mb-3 absolute-top-center">Login</div>
            <form action='./php/login.php' class="center entry-box mt-4" method='POST'>
                <label for="username_login">Username</label>
                <input type="text" name="username_login" class="" required>
                <label for="password_login">Password</label>
                <input type="password" name="password_login" class="" required>
                <button class="btn btn-primary w-50 center-x mt-4">Login</button>
                <div id="register_from_login" class="text-center no-wrap mt-2 cursor-pointer no-wrap">Non hai un account? <span
                        style='color: var(--blue);'>Registrati</span></div>
            </form>
        </div>
    </div>

    
    <div class="register entry">
        <div class="entry-container">
            <div class="close-button" id="register_close_button">+</div>
            <div class="fw-bold fs-3 text-center mb-3 absolute-top-center">Registrati</div>
            <form action="./php/register.php" class="center entry-box mt-4" method="POST">
                <div class="flex-row">
                    <div class="entry-box-container">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="" required>
                        <label for="Password">Password</label>
                        <input type="password" name="password" class="" required>
                    </div>
                    <div class="entry-box-container">
                        <label for="name">Nome</label>
                        <input type="text" name="firstname" required>
                        <label for="surname">Cognome</label>
                        <input type="text" name="surname">
                        <label for="city">Città</label required>
                        <input type="text" name="city">
                        <label for="cellphone" style="white-space: nowrap;">Numero di telefono</label>
                        <input type="number" name="cellphone" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-50 center-x mt-4">Register</button>
                <div id="login_from_register" class="text-center no-wrap mt-2 cursor-pointer no-wrap">Hai un account? <span
                        style='color: var(--blue);'>Login</span></div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
    </script>
    <script src="./static/searchProduct.js"></script>
    <script src="./static/showCategories.js"></script>
    <script src="./static/js.js"></script>
</body>
</html>