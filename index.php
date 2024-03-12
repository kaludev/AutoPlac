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
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
    
<?php 
        include("./components/header.php");
        ?>
    <div class="container">
        <main role="main" class="pb-3">
        <div class="hero-section row rounded-lg-md flex justify-content-start align-items-center mt-5">
                <div class="column mt-5">
                    <div class="ms-3 mb-5 text-weight-bold">
                        <p class="header text-light mb-4">Najveći izbor automobila kod nas</p>
                        <p class="basic text-light mb-4">Izaberite vaš budući automobil kod nas</p>
                        <div class="row flex justify-content-start">
                            <?php 
                                if(isset($_SESSION["email"])){
                                    echo '  
                                        <div class="col-5 col-md-2 mr-10">
                                            <a type="button" class=" container-fluid btn rounded btn-primary" asp-area="Identity" asp-page="/Account/Register" href="./register.php" >Registruj se</a>
                                        </div>
                                        <div class="col-5 col-md-2 mr-10">
                                            <a class="container-fluid btn rounded btn-secondary" asp-area="Identity" asp-page="/Account/Login" href="./login.php" >Prijavi se</a>
                                        </div>';
                                }
                                else
                                {
                                    echo '
                                    <div class="col-5 col-md-2 mr-10">
                                        <a type="button" class=" container-fluid btn rounded btn-primary" href="./register.php" >Registruj se</a>
                                    </div>
                                    <div class="col-5 col-md-2 mr-10">
                                        <a style="background-color:#F0F2F5; " class=" container-fluid btn rounded text-dark btn-secondary" href="./login.php" >Prijavi se</a>
                                    </div>';
                                }
                            ?>
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            <div class="container mt-5 mb-5 flex flex-column">
                <p class="header mt-5 mb-5">Test vožnja svakog automobila</p>
                <p class="basic mt-5 mb-5">Svaki od nasih automobila možete vratiti u roku od 7 dana ili 500 km</p>
                <a href="./oglasi.php"></a>
            </div>

            <div class="container mt-5 mb-5 pt-5 pb-5 flex flex-column">
                <div class="mt-5 mb-5 text-black container-fluid" style="font-family: 'Work Sans'; font-style: normal;font-weight: 900;font-size: 36px;line-height: 45px;text-align: center;letter-spacing: -1.188px;color: #121217;">
                    Želite li da naručite neki od naših automobnila?
                </div>
                <div class="d-flex justify-content-center align-content-center">
                    <div class="flex-column">
                        <?php 
                        if(isset($_SESSION["email"])){
                            echo '<div class="">
                                <a type="button" class=" container-fluid btn rounded btn-primary" asp-area="Identity" asp-page="/Account/Register" href="./register.php" >Registruj se</a>
                            </div>
                            <div class="">
                                <a class="container-fluid btn rounded btn-secondary" asp-area="Identity" asp-page="/Account/Login" href="./login.php" >Prijavi se</a>
                            </div>';
                        }
                        else
                        {
                            echo '
                            <div class="mt-4 mb-4">
                                <a type="button" class=" container-fluid btn rounded btn-primary" href="./register.php" >Registruj se</a>
                            </div>
                            <div class="mt-4 mb-4" >
                                <a style="background-color:#F0F2F5;" href="./login.php" class="border-none text-dark container-fluid btn rounded btn-secondary">Prijavi se</a>
                            </div>';
                        }
                        ?>
                    </div>
                    
                </div>
                
            </div>
        </main>
    </div>

    <footer class="border-top footer text-muted">
        <div class="container">
            &copy; 2024 - AutoPlac - <a href="./oglasi.php">Oglasi</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="~/js/site.js" asp-append-version="true"></script>
</body>
</html>
