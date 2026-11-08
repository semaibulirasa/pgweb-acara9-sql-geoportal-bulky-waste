<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Drop Off Bulky Waste, Jakarta</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 40px; text-align: center; }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 { color: #000080; margin-top: 0; }
        label { font-weight: bold; display: block; margin-top: 12px; margin-bottom: 5px; text-align: center; }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            text-align: center;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #000080;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            font-weight: bold;
        }
        input[type="submit"]:hover { background-color: #000055; }
        #informasi { color: red; font-weight: bold; margin-top: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Edit Drop Off Bulky Waste</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_bulky_waste";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM bulky_waste WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
        <form action="edit.php" onsubmit="return validateForm()" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <label for="nama_object">Nama Object:</label>
            <input type="text" id="nama_object" name="nama_object" value="<?php echo $row['nama_object']; ?>">

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>">

            <label for="lat">Y (Latitude):</label>
            <input type="text" id="lat" name="latitude" value="<?php echo $row['latitude']; ?>">

            <label for="long">X (Longitude):</label>
            <input type="text" id="long" name="longitude" value="<?php echo $row['longitude']; ?>">

            <label for="kelurahan">WADMKD (Kelurahan):</label>
            <input type="text" id="kelurahan" name="kelurahan" value="<?php echo $row['kelurahan']; ?>">

            <label for="kecamatan">WADMKC (Kecamatan):</label>
            <input type="text" id="kecamatan" name="kecamatan" value="<?php echo $row['kecamatan']; ?>">

            <label for="kota">WADMKK (Kota):</label>
            <input type="text" id="kota" name="kota" value="<?php echo $row['kota']; ?>">

            <input type="submit" value="Simpan Perubahan">
        </form>
<?php
    }
}
$conn->close();
?>

    <p id="informasi"></p>
</div>

<script>
function validateForm() {
    let lat = document.getElementById("lat").value;
    let long = document.getElementById("long").value;
    if (isNaN(lat) || isNaN(long) || lat === "" || long === "") {
        document.getElementById("informasi").innerHTML = "Koordinat Y (Latitude) dan X (Longitude) harus berupa angka valid";
        event.preventDefault();
        return false;
    }
}
</script>

</body>
</html>