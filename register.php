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
        function provera($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $usernameErr=$emailErr=$proveraErr=$passErr="";
        $pass=$username=$email=$provera="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid=true;
            if (empty($_POST["username"])) {
                
                $usernameErr = "Niste uneli korisnicko ime";
                $valid=false;
            }else{
                $username= provera($_POST["username"]);
            }
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
            if(empty($_POST["provera"])){
                $proveraErr = "Niste uneli proveru";
                $valid=false;
            }
            else {
                $provera= provera($_POST["provera"]);
                if ($provera!=$pass) {
                    $proveraErr = "Ne podudaraju se sifre";
                    $valid=false;
                }
            }
            if($valid)
            {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "autoplac";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM korisnici WHERE email = '$email'";
                $result = $conn->query($sql);
                if ($result->num_rows != 0) {
                    echo "Vrednost već postoji u bazi.";
                } else {
                    $sql = "INSERT INTO korisnici (korisnicko_ime,email, lozinka) VALUES ('$username','$email', '$pass')";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION["email"] = $email;
                        header("Location: ../index.php");
                    } else {
                        echo "Greška pri unosu podataka: " . $conn->error;
                    }

                }
            }else{
                echo"Nesto";
            }
        }
            ?>
            
            <div class="main row justify-content-center align-items-center d-flex">
                <div class="col-4 justify-content-center align-items-center d-flex flex-column">
                    <form class="align-items-center d-flex flex-column gap-0" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                         
                        
                        <div class="form-group mb-2">
                            <label for="username">Korisnicko ime<span class="error">*</span>:</p>
                            <input class="form-control" type="text" name="username">
                            <span class="error"><?php echo $usernameErr;?></span>
                        </div>  
                        <div class="form-group mb-2">
                            <label for="email">E-mail<span class="error">*</span>:</p>
                            <input class="form-control" type="text" name="email">
                            <span class="error"><?php echo $emailErr;?></span>
                        </div>    
                        <div class="form-group mb-2">
                            <p>Lozinka<span class="error">*</span>:</p> 
                            <input class="form-control" type="text" name="pass">
                            <span class="error"><?php echo $passErr;?></span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Provera lozinke<span class="error">*</span>:</p>
                            <input class="form-control" type="text" name="provera">
                            <span class="error"><?php echo $proveraErr;?></span>
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
            &copy; 2024 - AutoPlac - <a href="index.php">Pocetna</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="~/js/site.js" asp-append-version="true"></script>
</body>
</html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body class="row">

            

<?php
    

    ?>
</body>
</html>