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
        <?php
        if(isset($_SESSION["email"])){
            header("Location: index.php");
        }
        function provera($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $imeErr=$emailErr=$proveraErr=$passErr="";
        $ime=$email=$provera="";
        $valid=false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid=true;
            
              if (empty($_POST["email"])) {
                $emailErr = "Niste uneli email adresu";
                $valid=false;
            } else {
                $email = provera($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Pogresno uneta email adresa";
                    $valid=false;
                }
            }
            if (empty($_POST["pass"])) {
                $passErr = "Niste uneli lozinku";
                $valid=false;
            } else {
                $pass = provera($_POST["pass"]);
                if (strlen($pass)<6) {
                    $emailErr = "pass mora imati vise od 6 karaktera";
                    $valid=false;
                }
            }
            if($valid)
            {
                include('database/connect.php');
                $sql = "SELECT * FROM korisnici WHERE email = '$email'";
                $result = $conn->query($sql); 
                
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $dbpass=$row["lozinka"];
                    if ($dbpass == $pass) {
                        $_SESSION["email"] = $email;
                        header("Location: ../index.php");
                    } else {
                        echo "Pogresna ifra ";
                    }
                }
                } else {
                    
                    echo "Ne postoji nalog pod ovim mejlom.";
                }
            }
            
        }
            ?>
            <div class="main justify-content-center align-items-center flex-column d-flex">
            <p  class="header text-center mb-5">Prijavite se na vaš nalog</p>
                <div class="col-md-6 col-sm-9 col-11 justify-content-center align-items-center d-flex flex-column">
                    <form class="align-items-center container-fluid d-flex flex-column gap-0" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <div class="form-group col-12 mb-2">
                            <label for="email">E-mail<span class="error">*</span></label>
                            <input class="form-control" placeholder="E-mail" type="text" name="email">
                            <span class="error"><?php echo $emailErr;?></span>
                        </div>    
                        <div class="form-group col-12 mb-2">
                            <label for="pass">Lozinka<span class="error">*</span></label> 
                            <input class="form-control" placeholder="Lozinka" type="text" name="pass">
                            <span class="error"><?php echo $passErr;?></span>
                        </div>
                        <br>
                        <input type="submit" name="submit" class="btn btn-primary container-fluid" value="Potvrdi">  
                    </form>
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