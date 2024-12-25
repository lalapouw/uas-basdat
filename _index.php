<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data UKT Mahasiswa</title>
    <link rel="stylesheet" href="styles.css">
</head>


<?php 
include "koneksi.php";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$message = "";

if (isset($_POST['submit'])) {
    // Cek apakah NIM sudah ada
    $nim = $_POST['nim'];
    $result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE NIM = '$nim'");

    if (mysqli_num_rows($result) > 0) {
        $message = "Data dengan NIM tersebut sudah ada. Coba lagi.";
    } else {
        // Jika tidak ada, tambahkan data baru
        $query = "INSERT INTO mahasiswa SET
        nama = '$_POST[nama]',
        NIM = '$_POST[nim]',
        alamat = '$_POST[alamat]',
        prodi = '$_POST[prodi]',
        UKT = '$_POST[ukt]'";

        $execute = mysqli_query($koneksi, $query);

        // Cek apakah query berhasil
        if ($execute) {
            $message = "Data berhasil disimpan.";
        } else {
            $message = "Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>


<body>
    <div class="container">
        <h1>Data UKT Mahasiswa</h1>

        <?php if (isset($_POST['submit']) && !empty($message)): ?>
            <div class="message <?= strpos($message, 'berhasil') !== false ? 'success' : 'error'; ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi</label>
                <input type="text" id="prodi" name="prodi" required>
            </div>
            <div class="form-group">
                <label for="ukt">UKT</label>
                <input type="number" id="ukt" name="ukt" required>
            </div>
            <button type="submit" value="submit" name="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
