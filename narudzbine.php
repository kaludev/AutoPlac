<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Auto Plac</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto+Mono|Work+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    
    <?php 
        include("./components/header.php");
        ?>
    <div class="container">
        <main role="main" class="pb-3">
            <div class="main">
                <div class="container mb-5 flex row">
                    <?php 
                        include('./database/connect.php');
                        $email=$_SESSION["email"];
                        $sql = "SELECT narudzbina.*, oglasi.*
                        FROM narudzbina
                        JOIN oglasi ON narudzbina.oglas_id = oglasi.id
                        JOIN user ON narudzbina.user_id = user.id
                        WHERE user.email = '$email';";
                        
                        $result= $conn->query($sql);
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<div class="col-12 col-md-6 col-lg-3 justify-content-md-start justify-content-center align-items-md-start align-items-center text-md-left text-center d-flex flex-column">
                                    <div class=" rounded col-12 mb-2 mt-2">
                                        <img class="slika" src="images/'.$row['url_slike'].'" alt="'.$row['url_slike'].'">
                                    </div>
                                    <div class="naslov col-12 mb-2 mt-2">
                                        <p>'.$row['naslov'].'</p>
                                    </div>
                                    <div class="naslov cena col-12 mb-2 mt-2 d-flex row">
                                        <p class="col-7">'.$row['marka'].' '.$row['model'].'</p>
                                        <p class="col-4">'.$row['godina'].'. god.</p>
                                    </div>
                                    <div class="cena col-12 mb-2 mt-2">
                                        <p>$'.$row['cena'].'</p>
                                    </div>
                                    <div class="row col-12">';
                                    echo '<div class="col-12  col-md-6 mt-2 mb-2 mt-md-0 mb-md-0">
                                        <a type="button" class=" container-fluid btn rounded btn-secondary  " href="./oglas.php?id='.$row['id'].'" >Detalji</a>
                                    </div>';
                                    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
                                        echo '<div class="col-12  col-md-6 mr-10">
                                            <a type="button" class=" container-fluid btn rounded btn-primary" href="./otkazi.php?id='.$row['id'].'" >Otkazi</a>
                                        </div>';
                                    }
                                    echo '</div>';
                                    
                                echo '</div>';
                            }
                        }else{  
                            echo '<p class="header text-center ">Nema narudzbina</p>
                            <div class="d-flex justify-content-center align-content-center">
                                            <div class="col-md-4 col-sm-7 col-10">
                            <div class="mt-4 mb-4">
                                            <a type="button" class="container-fluid btn rounded btn-primary" href="./oglasi.php" >Oglasi</a>
                                        </div>
                                    </div>
                                </div>';
                        }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <footer class="border-top footer text-muted">
        <div class="container">
            &copy; 2024 - AutoPlac
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>