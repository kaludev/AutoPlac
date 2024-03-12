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
    
    <header>
        <nav style="box-sizing: border-box;border-bottom: 1px solid #E6E8EB;" class="navbar navbar-expand-md navbar-toggleable-md navbar-light bg-white box-shadow mb-3">
            <div class="container-fluid">
                <a class="navbar-brand"><img class="logo" src="./img/logo.png" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-md-inline-flex justify-content-end">
                    <ul class="navbar-nav flex-grow-1 justify-content-end">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-dark">Početna</a>
                        </li>
                        <li class="nav-item">
                            <a href="./pages/oglasi.php" class="nav-link text-dark">Oglasi</a>
                            
                        </li>
                        <?php 
                            if(isset($_SESSION['email'])){

                            }else{
                                echo '<li class="ms-md-2 me-md-2 mt-2 mb-2 mt-md-0 mb-md-0 nav-item">
                                    <a href="./pages/login.php" type="button" style="background-color:#F0F2F5;"  class="btn rounded btn-secondary text-dark">Login</a>
                                </li>';
                                echo '<li class="ms-md-2 me-md-2 mt-2 mb-2 mt-md-0 mb-md-0  nav-item">
                                    <a type="button" class="btn rounded btn-primary" href="./pages/register.php" >Registruj se</a>
                                </li>';
                            }
                        ?>
                    </ul>
                    
                </div>
            </div>
        </navstyle="box-sizing:>
    </header>
    <div class="container">
        <main role="main" class="pb-3">
        <div class="hero-section row rounded-lg-md flex justify-content-start align-items-center mt-5">
                <div class="column mt-5">
                    <div class="ms-3 mb-5 text-weight-bold">
                        <p class="header text-light mb-4">Najveći izbor automobila kod nas</p>
                        <p class="basic text-light mb-4">Izaberite automobil po vasoj meri kod nas</p>
                        <div class="row flex justify-content-start">
                            <?php 
                                if(isset($_SESSION["email"])){
                                    echo '  
                                        <div class="col-5 col-md-2 mr-10">
                                            <a type="button" class=" container-fluid btn rounded btn-primary" asp-area="Identity" asp-page="/Account/Register" href="./pages/register.php" >Registruj se</a>
                                        </div>
                                        <div class="col-5 col-md-2 mr-10">
                                            <a class="container-fluid btn rounded btn-secondary" asp-area="Identity" asp-page="/Account/Login" href="./pages/login.php" >Prijavi se</a>
                                        </div>';
                                }
                                else
                                {
                                    echo '
                                    <div class="col-5 col-md-2 mr-10">
                                        <a type="button" class=" container-fluid btn rounded btn-primary" href="./pages/register.php" >Registruj se</a>
                                    </div>
                                    <div class="col-5 col-md-2 mr-10">
                                        <a style="background-color:#F0F2F5; " class=" container-fluid btn rounded text-dark btn-secondary" href="./pages/login.php" >Prijavi se</a>
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
                <a href="./pages/oglasi.php"></a>
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
                                <a type="button" class=" container-fluid btn rounded btn-primary" asp-area="Identity" asp-page="/Account/Register" href="./pages/register.php" >Registruj se</a>
                            </div>
                            <div class="">
                                <a class="container-fluid btn rounded btn-secondary" asp-area="Identity" asp-page="/Account/Login" href="./pages/login.php" >Prijavi se</a>
                            </div>';
                        }
                        else
                        {
                            echo '
                            <div class="mt-4 mb-4">
                                <a type="button" class=" container-fluid btn rounded btn-primary" href="./pages/register.php" >Registruj se</a>
                            </div>
                            <div class="mt-4 mb-4" >
                                <a style="background-color:#F0F2F5;" href="./pages/login.php" class="border-none text-dark container-fluid btn rounded btn-secondary">Prijavi se</a>
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
            &copy; 2024 - AutoPlac - <a href="./pages/oglasi.php">Oglasi</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="~/js/site.js" asp-append-version="true"></script>
</body>
</html>
