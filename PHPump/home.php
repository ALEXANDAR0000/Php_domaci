<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

require_once("models/zaposleni.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHPump Gym</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>PHPump Gym</h1>
    <h3>Dobro došao, <?php echo $_SESSION['user_name']; ?></h3>
    <a href="logout.php">Logout</a> <br>
    <div class="link-container">
        <a href="clanoviCRUD.php" class="linkovi">Članovi</a>
        <a href="clanarineCRUD.php" class="linkovi">Članarine</a>
    </div>
    <div class="link-container">
        <a href="#" class="linkovi" id="prikaziZaposleneBtn">Prikaži sve zaposlene</a>
        <a href="#" class="linkovi" id="dodajZaposlenogBtn">Dodaj novog zaposlenog</a>
    </div>


    <main>
        <div id="content">
          
        </div>
    </main>

    <div id="zaposleniSection" style="display:none;">
        <h2>Lista Zaposlenih</h2>
        <table id="zaposleniTabela">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Zanimanje</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
    </div>

    <div id="dodajZaposlenogSection" style="display:none;">
        <h2>Dodaj Novog Zaposlenog</h2>
        <input type="text" id="user_name" placeholder="Username">
        <input type="password" id="password" placeholder="Password">
        <select id="zanimanje">
            <option value="trener">Trener</option>
            <option value="menadzer">Menadžer</option>
            <option value="admin">Admin</option>
        </select><br>
        <button id="submitZaposlenog">Dodaj</button>
    </div>

    <script>
        $(document).ready(function() {
            $('#prikaziZaposleneBtn').on('click', function() {
                $('#zaposleniSection').toggle();
                prikaziZaposlene();
            });

            $('#dodajZaposlenogBtn').on('click', function() {
                $('#dodajZaposlenogSection').toggle();
            });

            function prikaziZaposlene() {
                $.ajax({
                    url: 'ajax/prikaziZaposlene.php',
                    method: 'POST',
                    data: { akcija: 'prikazi' },
                    success: function(response) {
                        let zaposleni = JSON.parse(response);
                        let output = '';
                        zaposleni.forEach(function(zaposleni) {
                            output += `<tr>
                                          <td>${zaposleni.id}</td>
                                          <td>${zaposleni.user_name}</td>
                                          <td>${zaposleni.zanimanje}</td>
                                       </tr>`;
                        });
                        $('#zaposleniTabela tbody').html(output);
                    },
                    error: function(xhr, status, error) {
                        console.error("Greška u prikazu zaposlenih: ", status, error);
                    }
                });
            }

            $('#submitZaposlenog').on('click', function() {
                let user_name = $('#user_name').val();
                let password = $('#password').val();
                let zanimanje = $('#zanimanje').val();
      
                if(user_name && password && zanimanje) {
                    $.ajax({
                        url: 'ajax/dodajZaposlenog.php',
                        method: 'POST',
                        data: {
                            akcija: 'dodaj',
                            user_name: user_name,
                            password: password,
                            zanimanje: zanimanje
                        },
                        success: function(response) {
                            let result = JSON.parse(response);
                            alert(result.message);
                            prikaziZaposlene();
                        },
                        error: function(xhr, status, error) {
                            console.error("Greška u dodavanju zaposlenog: ", status, error);
                        }
                    });
                } else {
                    alert("Molimo popunite sva polja!");
                }
            });
        });
    </script>
</body>
</html>

<?php 
} else {
    header("Location: index.php");
    exit();
}
?>
