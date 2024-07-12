<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        // Edit jadwal
        $id = $_POST['id'];
        $nama_kegiatan = $_POST['nama_kegiatan'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        
        $sql = "UPDATE jadwal_ppdb SET nama_kegiatan = ?, tanggal_mulai = ?, tanggal_selesai = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_kegiatan, $tanggal_mulai, $tanggal_selesai, $id]);
    } else {
        // Tambah jadwal baru
        $nama_kegiatan = $_POST['nama_kegiatan'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        
        $sql = "INSERT INTO jadwal_ppdb (nama_kegiatan, tanggal_mulai, tanggal_selesai) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_kegiatan, $tanggal_mulai, $tanggal_selesai]);
    }
    
    header('Location: jadwal.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    echo "ID to delete: $id<br>"; // Debugging
    $sql = "DELETE FROM jadwal_ppdb WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$id]);
    echo "Delete result: $result<br>"; // Debugging
    
    header('Location: jadwal.php');
    exit();
}

$sql = "SELECT * FROM jadwal_ppdb";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$jadwal_ppdb = $stmt->fetchAll(PDO::FETCH_ASSOC);

$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $sql = "SELECT * FROM jadwal_ppdb WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $jadwal = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jadwal PPDB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Jadwal PPDB</h1>
    <form method="post">
        <div class="form-group">
            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="<?= $edit ? htmlspecialchars($jadwal['nama_kegiatan']) : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= $edit ? $jadwal['tanggal_mulai'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= $edit ? $jadwal['tanggal_selesai'] : '' ?>" required>
        </div>
        <?php if ($edit): ?>
            <input type="hidden" name="id" value="<?= $jadwal['id'] ?>">
            <button type="submit" class="btn btn-primary">Update Jadwal</button>
        <?php else: ?>
            <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
        <?php endif; ?>
    </form>
    <h2 class="mt-5">Daftar Jadwal PPDB</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jadwal_ppdb as $jadwal): ?>
                <tr>
                    <td><?= htmlspecialchars($jadwal['nama_kegiatan']) ?></td>
                    <td><?= htmlspecialchars($jadwal['tanggal_mulai']) ?></td>
                    <td><?= htmlspecialchars($jadwal['tanggal_selesai']) ?></td>
                    <td>
                        <a href="jadwal.php?edit=<?= $jadwal['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="jadwal.php?delete=<?= $jadwal['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
