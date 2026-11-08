<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_bulky_waste";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nama_object = $_POST['nama_object'];
$alamat = $_POST['alamat'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$kelurahan = $_POST['kelurahan'];
$kecamatan = $_POST['kecamatan'];
$kota = $_POST['kota'];

$sql = "INSERT INTO bulky_waste (nama_object, alamat, latitude, longitude, kelurahan, kecamatan, kota) 
        VALUES ('$nama_object', '$alamat', $latitude, $longitude, '$kelurahan', '$kecamatan', '$kota')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>