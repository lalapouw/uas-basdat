<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "data-mahasiswa";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT UKT FROM mahasiswa";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $ukt = [];
    while ($row = $result->fetch_assoc()) {
        $ukt[] = $row['UKT'];
    }

    $mean = array_sum($ukt) / count($ukt);
    $variance = array_sum(array_map(fn($x) => pow($x - $mean, 2), $ukt)) / count($ukt);
    $std_dev = sqrt($variance);

    echo "Standar Deviasi: $std_dev";
} else {
    echo "Tidak ada data UKT.";
}

$conn->close();
?>
