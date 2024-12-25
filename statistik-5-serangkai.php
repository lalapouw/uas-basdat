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

    sort($ukt);

    $min = min($ukt);
    $max = max($ukt);
    $q1 = $ukt[floor((count($ukt) - 1) * 0.25)];
    $median = $ukt[floor((count($ukt) - 1) * 0.5)];
    $q3 = $ukt[floor((count($ukt) - 1) * 0.75)];

    echo "Statistik 5 Serangkai:<br>";
    echo "Minimum: $min<br>";
    echo "Q1: $q1<br>";
    echo "Median: $median<br>";
    echo "Q3: $q3<br>";
    echo "Maximum: $max<br>";
} else {
    echo "Tidak ada data UKT.";
}

$conn->close();
?>
