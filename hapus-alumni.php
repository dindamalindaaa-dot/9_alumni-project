```php id="m7r4p1"
<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_alumni"
);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    header("Location: alumni.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM alumni WHERE id_alumni='$id'"
);

$alumni = mysqli_fetch_assoc($query);

if (!$alumni) {
    echo "Data alumni tidak ditemukan";
    exit;
}

if (isset($_POST['hapus'])) {

    $hapus = mysqli_query(
        $conn,
        "DELETE FROM alumni WHERE id_alumni='$id'"
    );

    if ($hapus) {
        echo "<script>
                alert('Data alumni berhasil dihapus');
                window.location='alumni.php';
              </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Alumni | Sistem Data Alumni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
     <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="app-wrapper">

    <aside class="sidebar">
        <div class="brand-box">
            <div class="brand-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div>
                <p class="brand-title">Alumni App</p>
                <p class="brand-subtitle">Sistem Data Alumni</p>
            </div>
        </div>

        <p class="menu-label">Menu Utama</p>

        <ul class="sidebar-menu">
            <li>
                <a href="dashboard.php">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="alumni.php">
                    <i class="bi bi-people-fill"></i> Data Alumni
                </a>
            </li>

            <li>
                <a href="tambah-alumni.php">
                    <i class="bi bi-person-plus-fill"></i> Tambah Alumni
                </a>
            </li>

            <li>
                <a href="index.php">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </li>
        </ul>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1 class="page-title">Hapus Data Alumni</h1>
                <p class="page-subtitle">
                    Pastikan data yang akan dihapus sudah benar.
                </p>
            </div>

            <a href="alumni.php" class="btn btn-soft">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <section class="content-card">

            <div class="empty-state">

                <div class="stat-icon bg-warning-soft mx-auto">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>

                <h2 class="fw-bold mb-3">
                    Konfirmasi Hapus Data
                </h2>

                <p class="text-muted mb-4">
                    Apakah Anda yakin ingin menghapus data alumni berikut?
                </p>

                <div class="table-responsive mb-4">

                    <table class="table table-bordered align-middle">

                        <tbody>

                            <tr>
                                <th class="bg-light" style="width:220px;">
                                    NIM
                                </th>
                                <td><?= $alumni['nim']; ?></td>
                            </tr>

                            <tr>
                                <th class="bg-light">
                                    Nama Alumni
                                </th>
                                <td><?= $alumni['nama_lengkap']; ?></td>
                            </tr>

                            <tr>
                                <th class="bg-light">
                                    Program Studi
                                </th>
                                <td><?= $alumni['program_studi']; ?></td>
                            </tr>

                            <tr>
                                <th class="bg-light">
                                    Tahun Lulus
                                </th>
                                <td><?= $alumni['tahun_lulus']; ?></td>
                            </tr>

                            <tr>
                                <th class="bg-light">
                                    Status Pekerjaan
                                </th>
                                <td><?= $alumni['status_pekerjaan']; ?></td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <form method="POST">

                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                        <a href="alumni.php" class="btn btn-soft">
                            Batal
                        </a>

                        <button type="submit"
                                name="hapus"
                                class="btn btn-danger rounded-3 px-4">

                            <i class="bi bi-trash me-2"></i>
                            Hapus Data

                        </button>

                    </div>

                </form>

            </div>

        </section>

        <p class="footer-note">
            Sistem Pengelolaan Data Alumni
        </p>

    </main>

</div>

</body>
</html>
```
