<?php
include 'config.php';

$sql = "SELECT * FROM jadwal_ppdb";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$jadwal_ppdb = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Jadwal PPDB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .table thead th {
            background-color: #343a40;
            color: #fff;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .title-icon {
            color: #007bff;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1><i class="fas fa-calendar-alt title-icon"></i>Daftar Jadwal PPDB</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jadwal_ppdb as $jadwal): ?>
                        <tr>
                            <td><?= htmlspecialchars($jadwal['nama_kegiatan']) ?></td>
                            <td><?= htmlspecialchars($jadwal['tanggal_mulai']) ?></td>
                            <td><?= htmlspecialchars($jadwal['tanggal_selesai']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
