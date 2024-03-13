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
                <?php 
                    include('./database/connect.php');
                    $id=$_GET["id"];
                    $sql = "SELECT * FROM oglasi WHERE id = $id";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();


                ?>
                <div style="background-image: url('images/<?php echo $row["url_slike"];?>'" class=" poster row rounded-lg-md flex justify-content-start align-items-end mt-5">
                    <div class="column mt-5">
                        <div class="ms-3  text-weight-bold">
                            <p class="header2 text-light mb-4"><?php echo "".$row["godina"]." ".$row["marka"]." ".$row["model"];?></p>
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