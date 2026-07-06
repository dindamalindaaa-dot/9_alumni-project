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

$total_alumni = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM alumni")
);

$total_bekerja = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM alumni WHERE status_pekerjaan='Bekerja'")
);

$total_wirausaha = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM alumni WHERE status_pekerjaan='Wirausaha'")
);

$total_studi = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM alumni WHERE status_pekerjaan='Studi Lanjut'")
);

$total_belum = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM alumni WHERE status_pekerjaan='Belum Bekerja'")
);

$status_query = mysqli_query($conn,"
SELECT
status_pekerjaan,
COUNT(*) as jumlah
FROM alumni
GROUP BY status_pekerjaan
");

$tahun_query = mysqli_query($conn,"
SELECT
tahun_lulus,
COUNT(*) as total
FROM alumni
GROUP BY tahun_lulus
ORDER BY tahun_lulus DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistem Data Alumni</title>

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
                <a href="dashboard.php" class="active">
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
                <h1 class="page-title">Dashboard Alumni</h1>
                <p class="page-subtitle">
                    Ringkasan data alumni, tahun lulus, dan status pekerjaan.
                </p>
            </div>

            <div class="user-pill">
                <i class="bi bi-person-circle me-2"></i>
                Admin Alumni
            </div>
        </div>

        <div class="row g-4 mb-4">

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary-soft">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <p class="stat-number">
                        <?= $total_alumni ?>
                    </p>

                    <p class="stat-label mb-0">
                        Total Alumni
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success-soft">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>

                    <p class="stat-number">
                        <?= $total_bekerja ?>
                    </p>

                    <p class="stat-label mb-0">
                        Bekerja
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning-soft">
                        <i class="bi bi-shop"></i>
                    </div>

                    <p class="stat-number">
                        <?= $total_wirausaha ?>
                    </p>

                    <p class="stat-label mb-0">
                        Wirausaha
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon bg-info-soft">
                        <i class="bi bi-book-fill"></i>
                    </div>

                    <p class="stat-number">
                        <?= $total_studi ?>
                    </p>

                    <p class="stat-label mb-0">
                        Studi Lanjut
                    </p>
                </div>
            </div>

        </div>

        <div class="row g-4">

            <div class="col-lg-7">

                <section class="content-card">

                    <h2 class="card-heading">
                        Rekap Status Pekerjaan
                    </h2>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status Pekerjaan</th>
                                    <th>Jumlah Alumni</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php
                            $no = 1;

                            while($status = mysqli_fetch_assoc($status_query)):

                            $persen = ($total_alumni > 0)
                                ? round(($status['jumlah'] / $total_alumni) * 100)
                                : 0;
                            ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td>
                                    <?= htmlspecialchars($status['status_pekerjaan']) ?>
                                </td>

                                <td>
                                    <?= $status['jumlah'] ?>
                                </td>

                                <td>
                                    <?= $persen ?>%
                                </td>

                            </tr>

                            <?php endwhile; ?>

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

            <div class="col-lg-5">

                <section class="content-card">

                    <h2 class="card-heading">
                        Rekap Tahun Lulus
                    </h2>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <th>Total Alumni</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php while($tahun = mysqli_fetch_assoc($tahun_query)): ?>

                            <tr>

                                <td>
                                    <?= $tahun['tahun_lulus'] ?>
                                </td>

                                <td>
                                    <?= $tahun['total'] ?>
                                </td>

                            </tr>

                            <?php endwhile; ?>

                            </tbody>

                        </table>

                    </div>

                    <a href="alumni.php" class="btn btn-soft mt-3">
                        <i class="bi bi-search me-2"></i>
                        Lihat Data Alumni
                    </a>

                </section>

            </div>

        </div>

        <p class="footer-note">
            © 2026 Sistem Informasi data alumni. All rights reserved.
        </p>

    </main>

</div>

</body>
</html>