<!DOCTYPE html>
<html>
<head>
    <title>Članovi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Lista Članova</h2>
        <a class="btn btn-danger mb-3" href="/PHPump/home.php" role="button">Nazad</a>
        <a class="btn btn-primary mb-3" href="/PHPump/createClan.php" role="button">Dodaj Člana</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Datum rodjenja</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once("config.php");
                    $sql = "SELECT * FROM clanovi";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['ime']}</td>
                            <td>{$row['prezime']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['telefon']}</td>
                            <td>{$row['datum_rodjenja']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/PHPump/editClan.php?id={$row['id']}'>Izmeni</a>
                                <a class='btn btn-danger btn-sm' href='/PHPump/deleteClan.php?id={$row['id']}'>Obrisi</a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
