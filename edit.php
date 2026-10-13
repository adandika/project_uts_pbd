<?php
require 'koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM barang WHERE idbarang = ?");
$stmt->execute([$id]);
$barang = $stmt->fetch(PDO::FETCH_ASSOC);

$satuan = $pdo->query("SELECT * FROM vw_satuan")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis = $_POST['jenis'];
    $nama = $_POST['nama'];
    $idsatuan = $_POST['idsatuan'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];

    $update = $pdo->prepare("UPDATE barang SET jenis = ?, nama = ?, idsatuan = ?, status = ?, harga = ? WHERE idbarang = ?");
    $update->execute([$jenis, $nama, $idsatuan, $status, $harga, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f7f6; color: #333; }
        form { background: #fff; padding: 20px; width: 400px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #f39c12; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { opacity: 0.8; }
        a { color: #555; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Form Edit Barang Voli</h2>
    <form method="POST">
        <div>
            <label>Jenis:</label>
            <input type="text" name="jenis" maxlength="1" value="<?= $barang['jenis']; ?>" required>
        </div>
        <div>
            <label>Nama Barang:</label>
            <input type="text" name="nama" value="<?= $barang['nama']; ?>" required>
        </div>
        <div>
            <label>Satuan:</label>
            <select name="idsatuan" required>
                <?php foreach ($satuan as $s): ?>
                    <option value="<?= $s['idsatuan']; ?>" <?= ($s['idsatuan'] == $barang['idsatuan']) ? 'selected' : ''; ?>>
                        <?= $s['nama_satuan']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Status:</label>
            <input type="number" name="status" value="<?= $barang['status']; ?>" required>
        </div>
        <div>
            <label>Harga:</label>
            <input type="number" name="harga" value="<?= $barang['harga']; ?>" required>
        </div>
        <button type="submit">Perbarui Data</button>
        <a href="index.php" style="margin-left: 10px;">Batal</a>
    </form>
</body>
</html>