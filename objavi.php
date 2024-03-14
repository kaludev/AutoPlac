
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
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h2 class="mb-4">Unos podataka</h2>
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="naslov" class="form-label">Naslov</label>
                                <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Unesite naslov" required>
                            </div>
                            <div class="mb-3">
                                <label for="opis" class="form-label">Opis</label>
                                <textarea class="form-control" id="opis" name="opis" rows="3" placeholder="Unesite opis" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="marka" class="form-label">Marka</label>
                                <input type="text" class="form-control" id="marka" name="marka" placeholder="Unesite marku" required>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Unesite model" required>
                            </div>
                            <div class="mb-3">
                                <label for="godina" class="form-label">Godina</label>
                                <input type="number" class="form-control" id="godina" name="godina" placeholder="Unesite godinu" required>
                            </div>
                            <div class="mb-3">
                                <label for="cena" class="form-label">Cena</label>
                                <input type="number" class="form-control" id="cena" name="cena" placeholder="Unesite cenu" required>
                            </div>
                            <div class="mb-3">
                                <label for="kilometraza" class="form-label">Kilometraža</label>
                                <input type="number" class="form-control" id="kilometraza" name="kilometraza" placeholder="Unesite kilometražu">
                            </div>
                            <div class="mb-3">
                                <label for="url_slike" class="form-label">Izaberite sliku</label>
                                <input type="file" class="form-control" id="url_slike" name="url_slike">
                            </div>
                            <button type="submit" class="btn btn-primary">Potvrdi unos</button>
                            </form>
                            
                            <?php 
include('./database/connect.php');

// Provera da li je forma poslata
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION["email"])) {
        // Pronalaženje ID-a trenutnog korisnika na osnovu email-a
        $userSql = "SELECT id FROM user WHERE email='" . $_SESSION["email"] . "'";
        $result = $conn->query($userSql);

        // Provera da li je korisnik pronađen
        if ($result->num_rows > 0) {
            // Prihvatanje podataka iz forme
            $naslov = $_POST['naslov'];
            $opis = $_POST['opis'];
            $marka = $_POST['marka'];
            $model = $_POST['model'];
            $godina = $_POST['godina'];
            $cena = $_POST['cena'];
            $kilometraza = $_POST['kilometraza'];
            $row = $result->fetch_assoc();
            $kreator_id = $row['id'];
            // Validacija podataka
            $errors = array();
            
            // Naslov ne sme biti prazan
            if (empty($naslov)) {
                $errors[] = "Naslov je obavezan.";
            }
            
            // Opis ne sme biti prazan
            if (empty($opis)) {
                $errors[] = "Opis je obavezan.";
            }
            
            // Marka ne sme biti prazna
            if (empty($marka)) {
                $errors[] = "Marka je obavezna.";
            }
            
            // Model ne sme biti prazan
            if (empty($model)) {
                $errors[] = "Model je obavezan.";
            }
            
            // Godina mora biti broj i ne sme biti prazna
            if (!is_numeric($godina) || empty($godina)) {
                $errors[] = "Godina mora biti broj.";
            }
            
            // Cena mora biti broj i ne sme biti prazna
            if (!is_numeric($cena) || empty($cena)) {
                $errors[] = "Cena mora biti broj.";
            }
            
            // Ako nema grešaka, nastavljamo sa unosom podataka
            if (empty($errors)) {
                // Čuvanje slike na serveru
                $targetDir = "images/";
                $fileName = basename($_FILES["url_slike"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
                // Dozvoljeni formati slike
                $allowTypes = array('jpg','png','jpeg','gif');
                if (in_array($fileType, $allowTypes)) {
                    // Upload slike na server
                    if (move_uploaded_file($_FILES["url_slike"]["tmp_name"], $targetFilePath)) {
                        // SQL upit za unos podataka u bazu
                        $sql = "INSERT INTO oglasi (naslov, opis, marka, model, godina, cena, kilometraza, url_slike,kreator_id) VALUES ('$naslov', '$opis', '$marka', '$model', '$godina', '$cena', '$kilometraza', '$fileName','$kreator_id')";

                        // Izvršavanje upita za unos
                        if ($conn->query($sql) === TRUE) {
                            echo "Podaci uspešno uneti.";
                        } else {
                            echo "Greška pri unosu podataka: " . $conn->error;
                        }
                    } else {
                        echo "Greška pri uploadu slike.";
                    }
                } else {
                    echo 'Dozvoljeni formati slike su JPG, JPEG, PNG, GIF.';
                }
            } else {
                // Ako postoje greške, ispisujemo ih
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
            }
        } else {
            echo "Korisnik nije pronađen";
        }
    } else {
        echo "Korisnik nije prijavljen";
    }
    
}
?>
                        </div>
                    </div>
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