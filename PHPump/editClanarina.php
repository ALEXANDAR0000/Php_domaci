<?php
include_once("config.php");

$id = "";
$clan_id = "";
$datum_pocetka = "";
$datum_kraja = "";
$status = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: clanarineCRUD.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM clanarine WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: clanarineCRUD.php");
        exit;
    }
    $clan_id = $row["clan_id"];
    $datum_pocetka = $row["datum_pocetka"];
    $datum_kraja = $row["datum_kraja"];
    $status = $row["status"];
} else {
    $id = $_POST["id"];
    $clan_id = $_POST["clan_id"];
    $datum_pocetka = $_POST["datum_pocetka"];
    $datum_kraja = $_POST["datum_kraja"];
    $status = $_POST["status"];

    do {
        if (empty($id) || empty($clan_id) || empty($datum_pocetka) || empty($datum_kraja) || empty($status)) {
            $errorMessage = "Sva polja su obavezna";
            break;
        }

        $sql = "UPDATE clanarine SET clan_id='$clan_id', datum_pocetka='$datum_pocetka', datum_kraja='$datum_kraja', status='$status' WHERE id='$id'";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $successMessage = "Članarina je uspešno izmenjena";
        header("Location: clanarineCRUD.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Izmeni Članarinu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Izmeni Članarinu</h2>
        <?php if (!empty($errorMessage)) : ?>
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong><?php echo $errorMessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Član id</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="clan_id" value="<?php echo $clan_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Datum početka</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="datum_pocetka" value="<?php echo $datum_pocetka; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Datum kraja</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="datum_kraja" value="<?php echo $datum_kraja; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <select class="form-control" name="status">
                        <option value="aktivan" <?php if ($status == 'aktivna') echo 'selected'; ?>>Aktivna</option>
                        <option value="istekao" <?php if ($status == 'istekla') echo 'selected'; ?>>Istekla</option>
                    </select>
                </div>
            </div>
            
            <?php if (!empty($successMessage)) : ?>
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong><?php echo $successMessage; ?></strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Sačuvaj</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PHPump/clanarineCRUD.php" role="button">Otkaži</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
