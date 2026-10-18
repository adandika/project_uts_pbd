<?php
require 'koneksi.php';

if (isset($_GET['hapus'])) {
    $idbarang = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM barang WHERE idbarang = ?");
    $stmt->execute([$idbarang]);
    header("Location: index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM vw_barang");
$barangs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Barang - Toko Voli</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f7f6; color: #333; }
        h2 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 5px; overflow: hidden; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        a { text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 14px; }
        .btn-tambah { background: #2ecc71; color: white; margin-bottom: 15px; display: inline-block; }
        .btn-edit { background: #f39c12; color: white; }
        .btn-hapus { background: #e74c3c; color: white; }
        a:hover { opacity: 0.8; }
    </style>
</head>
<body>

    <h2>Data Barang - Toko Peralatan Olahraga Voli</h2>
    <a href="tambah.php" class="btn-tambah">+ Tambah Barang Baru</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Status</th>
                <th>Harga (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barangs as $b): ?>
            <tr>
                <td><?= $b['idbarang']; ?></td>
                <td><?= $b['jenis']; ?></td>
                <td><?= $b['nama_barang']; ?></td>
                <td><?= $b['nama_satuan']; ?></td>
                <td><?= $b['status']; ?></td>
                <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
                <td>
                    <a href="edit.php?id=<?= $b['idbarang']; ?>" class="btn-edit">Edit</a>
                    <a href="index.php?hapus=<?= $b['idbarang']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
