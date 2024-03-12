<!DOCTYPE html>
<?php
session_start();
?>
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
        function provera($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $imeErr=$emailErr=$proveraErr=$sifraErr="";
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
            if (empty($_POST["sifra"])) {
                $sifraErr = "Niste uneli lozinku";
                $valid=false;
            } else {
                $sifra = provera($_POST["sifra"]);
                if (strlen($sifra)<6) {
                    $emailErr = "Sifra mora imati vise od 6 karaktera";
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
                
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $dbsifra=$row["lozinka"];
                    if ($dbsifra == $sifra) {
                        $_SESSION["email"] = $email;
                        header("Location: ../index.php");
                    } else {
                        echo "Pogresna sifra ";
                    }
                }
                } else {
                    
                    echo "Ne postoji nalog pod ovim mejlom.";
                }
            }
            
        }
            ?>
            <div class="prazan col-12"></div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 centar">
                    <form class="regform" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        E-mail: <input type="text" name="email">
                        <span class="error">* <?php echo $emailErr;?></span>
                        <br><br>
                        Lozinka: <input type="text" name="sifra">
                        <span class="error">* <?php echo $sifraErr;?></span>
                        <br><br> 
                        <input type="submit" name="submit" value="Potvrdi">  
                    </form>
                </div>
                <div class="col-4"></div>
            </div>
            

<?php
    

    ?>
</body>
</html>