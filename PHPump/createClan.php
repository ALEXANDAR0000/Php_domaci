<?php
include_once("config.php");

$ime = "";
$prezime = "";
$email = "";
$telefon = "";
$datum_rodjenja = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $datum_rodjenja = $_POST["datum_rodjenja"];

    do {
        if (empty($ime) || empty($prezime) || empty($email) || empty($telefon) || empty($datum_rodjenja)) {
            $errorMessage = "Sva polja su obavezna";
            break;
        }

        $sql = "INSERT INTO clanovi (ime, prezime, email, telefon, datum_rodjenja) VALUES ('$ime', '$prezime', '$email', '$telefon', '$datum_rodjenja')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $ime = "";
        $prezime = "";
        $email = "";
        $telefon = "";
        $datum_rodjenja = "";

        $successMessage = "Član je uspešno dodat";

        header("Location: clanoviCRUD.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dodaj</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Novi Član</h2>
        <?php 
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ime</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ime" value="<?php echo $ime; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prezime</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prezime" value="<?php echo $prezime; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefon</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="telefon" value="<?php echo $telefon; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Datum rodjenja</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="datum_rodjenja" value="<?php echo $datum_rodjenja; ?>">
                </div>
            </div>
            <?php 
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Sačuvaj</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHPump/clanoviCRUD.php" role="button">Otkaži</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
