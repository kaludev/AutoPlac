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
        $usernameErr=$emailErr=$lozinkaPonovoErr=$passErr="";
        $pass=$username=$email=$lozinkaPonovo="";
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
                $lozinkaPonovoErr = "Niste uneli proveru";
                $valid=false;
            }
            else {
                $lozinkaPonovo= provera($_POST["provera"]);
                if ($lozinkaPonovo!=$pass) {
                    $lozinkaPonovoErr = "Ne podudaraju se sifre";
                    $valid=false;
                }
            }
            if($valid)
            {
                include("database/connect.php");
                $sql = "SELECT * FROM user WHERE email = '$email'";
                $result = $conn->query($sql);
                if ($result->num_rows != 0) {
                    echo "Vrednost već postoji u bazi.";
                } else {
                    $hashedPass = password_hash($pass,PASSWORD_DEFAULT);
                    var_dump($hashedPass);
                    $sql = "INSERT INTO user (username,email, password) VALUES ('$username','$email', '$hashedPass')";
                    var_dump($sql);
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION["email"] = $email;
                        header("Location: index.php");
                    } else {
                        echo "Greška pri unosu podataka: " . $conn->error;
                    }

                }
            }else{
                echo"Nesto";
            }
        }
            ?>
            
            <div class="main justify-content-center align-items-center flex-column d-flex">
                <p  class="header text-center mb-5">Registrujte se na vaš nalog</p>
                <div class="col-md-6 col-sm-9 col-12 align-items-center d-flex flex-column">

                    <form class=" d-flex flex-column container-fluid gap-0" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                         
                        
                        <div class="form-group mb-2 col-12">
                            <label for="username">Korisnicko ime<span class="error">*</span></label>
                            <input class="form-control" type="text" placeholder="Korisnicko ime" name="username">
                            <span class="error"><?php echo $usernameErr;?></span>
                        </div>  
                        <div class="form-group mb-2 col-12">
                            <label for="email">E-mail<span class="error">*</span></label>
                            <input class="form-control" type="text" placeholder="E-mail" name="email">
                            <span class="error"><?php echo $emailErr;?></span>
                        </div>    
                        <div class="form-group mb-2 col-12">
                            <label for="pass">Lozinka<span class="error">*</span></label> 
                            <input class="form-control" type="password" placeholder="Lozinka" name="pass">
                            <span class="error"><?php echo $passErr;?></span>
                        </div>
                        <div class="form-group mb-2 col-12">
                            <label for="provera">Provera lozinke<span class="error">*</span></label>
                            <input class="form-control" type="text" placeholder="Ponovi lozinku" name="provera">
                            <span class="error"><?php echo $lozinkaPonovoErr;?></span>
                        </div> 
                        <br>
                        <input type="submit" name="submit" class="btn btn-primary " value="Potvrdi">
                         
                        
                    </form>
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