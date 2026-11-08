<!DOCTYPE html>
<html>
<head>
    <title>Web GIS - Drop Off Bulky Waste, Jakarta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; text-align: center; background-color: #f8f9fa; }
        h2 { color: #000080; margin-bottom: 20px; }
        .table-container { max-width: 1300px; margin: 20px auto; overflow-x: auto; }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin: 0 auto; 
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 14px 16px; 
            text-align: center; 
            vertical-align: middle;
            line-height: 1.4;
        }
        tr:nth-child(even) { background-color: #fdfdfd; }
        th { background-color: #000080; color: white; font-weight: 600; }
        th i { margin-right: 6px; display: block; margin-bottom: 4px; font-size: 16px; }
        
        .btn-tambah {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000080;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .btn-tambah:hover { background-color: #000055; }
        .btn-tambah i { margin-right: 8px; }

        .btn-edit, .btn-hapus {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            margin: 2px 4px;
        }
        .btn-edit { color: #000080; border: 1px solid #000080; background-color: #f0f0ff; }
        .btn-edit:hover { background-color: #000080; color: white; }
        .btn-hapus { color: #d9534f; border: 1px solid #d9534f; background-color: #fff5f5; }
        .btn-hapus:hover { background-color: #d9534f; color: white; }
        .btn-edit i, .btn-hapus i { margin-right: 4px; }
    </style>
</head>
<body>

<h2>Data Lokasi Drop Off Bulky Waste</h2>
<a href="input/index.html" class="btn-tambah"><i class="fa-solid fa-plus"></i> Tambah Data Baru</a>

<div class="table-container">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_bulky_waste";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bulky_waste";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th><i class='fa-solid fa-list-ol'></i>OBJECTID</th>
                <th><i class='fa-solid fa-trash-can'></i>Nama Object</th>
                <th><i class='fa-solid fa-location-dot'></i>Alamat</th>
                <th><i class='fa-solid fa-arrows-up-down'></i>Y</th>
                <th><i class='fa-solid fa-arrows-left-right'></i>X</th>
                <th><i class='fa-solid fa-city'></i>WADMKD</th>
                <th><i class='fa-solid fa-building-flag'></i>WADMKC</th>
                <th><i class='fa-solid fa-map-location-dot'></i>WADMKK</th>
                <th><i class='fa-solid fa-gear'></i>Aksi</th>
            </tr>";
    
    $no = 1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $no++ . "</td>
                <td>" . $row["nama_object"] . "</td>
                <td>" . $row["alamat"] . "</td>
                <td>" . $row["latitude"] . "</td>
                <td>" . $row["longitude"] . "</td>
                <td>" . $row["kelurahan"] . "</td>
                <td>" . $row["kecamatan"] . "</td>
                <td>" . $row["kota"] . "</td>
                <td style='white-space: nowrap;'>
                    <a href='edit/index.php?id=" . $row["id"] . "' class='btn-edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                    <a href='delete.php?id=" . $row["id"] . "' class='btn-hapus' onclick='return confirm(\"Apakah yakin ingin menghapus data ini?\");'><i class='fa-solid fa-trash'></i> Hapus</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Belum ada data.</p>";
}
$conn->close();
?>
</div>

</body>
</html>