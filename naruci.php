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
        if(!isset($_SESSION["email"])) {
            header("Location: index.php"); 
        }
    ?>
    <?php 
        include("./components/header.php");
    ?>
    <div class="container">
        <main role="main" class="pb-3">
            <div class="main">
                <div class="container mb-5 flex row">
                <?php 
                    include('./database/connect.php');

                    // Provera da li je ID oglasa prosleđen kroz GET
                    if(isset($_GET["id"])) {
                        $id = $_GET["id"];

                        // Provera da li je korisnik prijavljen
                        if(isset($_SESSION["email"])) {
                            // Pronalaženje ID-a trenutnog korisnika na osnovu email-a
                            $userSql = "SELECT id FROM user WHERE email='" . $_SESSION["email"] . "'";
                            $result = $conn->query($userSql);

                            // Provera da li je korisnik pronađen
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $user_id = $row["id"];

                                // SQL upit za dodavanje narudžbine za datog korisnika i oglas
                                $sql = "INSERT INTO narudzbina (user_id, oglas_id) VALUES ('$user_id', '$id')";

                                // Izvršavanje upita za dodavanje
                                if ($conn->query($sql) === TRUE) {
                                    echo "Uspešno poručeno";
                                    echo '<div class="d-flex justify-content-center align-content-center">
                                            <div class="col-md-4 col-sm-7 col-10">';
                                    if(isset($_SESSION["email"])){
                                        echo '
                                        <div class="mt-4 mb-4">
                                            <a type="button" class="container-fluid btn rounded btn-primary" href="./oglasi.php" >Oglasi</a>
                                        </div>
                                        <div class="mt-4 mb-4" >
                                            <a  href="./narudzbine.php" class="border-none container-fluid btn rounded btn-secondary">Narudzbine</a>
                                        </div>';
                                    }
                                    else
                                    {
                                        echo '
                                        <div class="mt-4 mb-4">
                                            <a type="button" class="container-fluid btn rounded btn-primary" href="./register.php" >Registruj se</a>
                                        </div>
                                        <div class="mt-4 mb-4" >
                                            <a  href="./login.php" class="border-none container-fluid btn rounded btn-secondary">Prijavi se</a>
                                        </div>';
                                    }
                                    echo'</div>
                                    
                                </div>';
                                } else {
                                    echo "Greška pri unosu podataka: " . $conn->error;
                                }
                            } else {
                                echo "Korisnik nije pronađen";
                            }
                        } else {
                            echo "Korisnik nije prijavljen";
                        }
                    } else {
                        echo "ID oglasa nije prosleđen";
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