<!DOCTYPE html>
<html>
<head>
    <title>Članovi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Lista Članarina</h2>
        <a class="btn btn-danger mb-3" href="home.php" role="button">Nazad</a>
        <a class="btn btn-primary mb-3" href="/PHPump/createClanarine.php" role="button">Dodaj Članarinu</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Član id</th>
                    <th>Datum početka</th>
                    <th>Datum kraja</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once("config.php");
                    $sql = "SELECT * FROM clanarine";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['clan_id']}</td>
                            <td>{$row['datum_pocetka']}</td>
                            <td>{$row['datum_kraja']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/PHPump/editClanarina.php?id={$row['id']}'>Izmeni</a>
                                <a class='btn btn-danger btn-sm' href='/PHPump/deleteClanarina.php?id={$row['id']}'>Obrisi</a>
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
