<?php
require 'koneksi.php';

$satuan = $pdo->query("SELECT * FROM vw_satuan")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis = $_POST['jenis'];
    $nama = $_POST['nama'];
    $idsatuan = $_POST['idsatuan'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];

    $stmt = $pdo->prepare("INSERT INTO barang (jenis, nama, idsatuan, status, harga) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$jenis, $nama, $idsatuan, $status, $harga]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f7f6; color: #333; }
        form { background: #fff; padding: 20px; width: 400px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #2ecc71; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { opacity: 0.8; }
        a { color: #555; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Form Tambah Barang Voli</h2>
    <form method="POST">
        <div>
            <label>Jenis (Contoh: A/B):</label>
            <input type="text" name="jenis" maxlength="1" required>
        </div>
        <div>
            <label>Nama Barang:</label>
            <input type="text" name="nama" required>
        </div>
        <div>
            <label>Satuan:</label>
            <select name="idsatuan" required>
                <?php foreach ($satuan as $s): ?>
                    <option value="<?= $s['idsatuan']; ?>"><?= $s['nama_satuan']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Status (1 = Aktif, 0 = Nonaktif):</label>
            <input type="number" name="status" value="1" required>
        </div>
        <div>
            <label>Harga:</label>
            <input type="number" name="harga" required>
        </div>
        <button type="submit">Simpan Data</button>
        <a href="index.php" style="margin-left: 10px;">Batal</a>
    </form>
</body>
</html>