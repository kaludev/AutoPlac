<header>
        <nav style="box-sizing: border-box;border-bottom: 1px solid #E6E8EB;" class="navbar navbar-expand-md navbar-toggleable-md navbar-light bg-white box-shadow mb-3">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand"><img class="logo" src="./img/logo.png" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-md-inline-flex justify-content-end">
                    <ul class="navbar-nav flex-grow-1 justify-content-end">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link text-dark">Početna</a>
                        </li>
                        <li class="nav-item">
                            <a href="oglasi.php" class="nav-link text-dark">Oglasi</a>
                            
                        </li>
                        <?php 
                            if(isset($_SESSION['email'])){

                            }else{
                                echo '<li class="ms-md-2 me-md-2 mt-2 mb-2 mt-md-0 mb-md-0 nav-item">
                                    <a href="./login.php" type="button" style="background-color:#F0F2F5;"  class="btn rounded btn-secondary text-dark">Login</a>
                                </li>';
                                echo '<li class="ms-md-2 me-md-2 mt-2 mb-2 mt-md-0 mb-md-0  nav-item">
                                    <a type="button" class="btn rounded btn-primary" href="./register.php" >Registruj se</a>
                                </li>';
                            }
                        ?>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>