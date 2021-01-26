 <?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "movietrak"; 

// Konekcija sa bazom
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?> 