<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<title>PHPump gym</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
        <h1>PHPump Gym</h1>
        <h3>Dobro došao, <?php echo $_SESSION['name']; ?></h3>
        <a href="logout.php">Logout</a> </br>
        <div class="link-container">
        <a href="clanovi.php" class="linkovi">Članovi</a>
        <a href="clanarine.php" class="linkovi">Članarine</a></div>
        
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>
