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

    $q1 = $ukt[floor((count($ukt) - 1) * 0.25)];
    $q3 = $ukt[floor((count($ukt) - 1) * 0.75)];
    $iqr = $q3 - $q1;
    $lower_bound = $q1 - 1.5 * $iqr;
    $upper_bound = $q3 + 1.5 * $iqr;

    $pencilan_bawah = array_filter($ukt, fn($x) => $x < $lower_bound);
    $pencilan_atas = array_filter($ukt, fn($x) => $x > $upper_bound);

    echo "Pencilan Bawah:<br>";
    echo implode(", ", $pencilan_bawah) . "<br>";

    echo "Pencilan Atas:<br>";
    echo implode(", ", $pencilan_atas) . "<br>";
} else {
    echo "Tidak ada data UKT.";
}

$conn->close();
?>
