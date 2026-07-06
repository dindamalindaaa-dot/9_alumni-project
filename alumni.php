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

$nama = $_GET['nama'] ?? '';
$tahun_lulus = $_GET['tahun_lulus'] ?? '';
$status = $_GET['status'] ?? '';

$nama = mysqli_real_escape_string($conn, $nama);

$sql = "SELECT * FROM alumni WHERE 1=1";

if (!empty($nama)) {
    $sql .= " AND nama_lengkap LIKE '%$nama%'";
}

if (!empty($tahun_lulus)) {
    $sql .= " AND tahun_lulus='$tahun_lulus'";
}

if (!empty($status)) {
    $sql .= " AND status_pekerjaan='$status'";
}

$sql .= " ORDER BY id_alumni DESC";

$query = mysqli_query($conn, $sql);
$total_data = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alumni | Sistem Data Alumni</title>

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
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="alumni.php" class="active">
                    <i class="bi bi-people-fill"></i>
                    Data Alumni
                </a>
            </li>

            <li>
                <a href="tambah-alumni.php">
                    <i class="bi bi-person-plus-fill"></i>
                    Tambah Alumni
                </a>
            </li>

            <li>
                <a href="index.php">
                    <i class="bi bi-box-arrow-left"></i>
                    Logout
                </a>
            </li>
        </ul>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1 class="page-title">Data Alumni</h1>
                <p class="page-subtitle">
                    Kelola data alumni, cari nama, dan filter berdasarkan tahun lulus.
                </p>
            </div>

            <a href="tambah-alumni.php" class="btn btn-main">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah Alumni
            </a>
        </div>

        <section class="filter-box">

            <form method="GET">

                <div class="row g-3">

                    <div class="col-lg-4">
                        <label class="form-label">Pencarian Nama</label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Cari nama alumni"
                            value="<?= htmlspecialchars($nama); ?>"
                        >
                    </div>


                    
                     <div class="col-lg-3">
                        <label class="form-label">Tahun Lulus</label>

                        <select name="tahun_lulus" class="form-select">

                            <option value="">Semua Tahun</option>

                            <?php
                            $tahun_query = mysqli_query(
                                $conn,
                                "SELECT DISTINCT tahun_lulus
                                 FROM alumni
                                 ORDER BY tahun_lulus DESC"
                            );

                            while($tahun = mysqli_fetch_assoc($tahun_query)):
                            ?>

                            <option
                                value="<?= $tahun['tahun_lulus']; ?>"
                                <?= ($tahun_lulus == $tahun['tahun_lulus']) ? 'selected' : ''; ?>
                            >
                                <?= $tahun['tahun_lulus']; ?>
                            </option>

                            <?php endwhile; ?>

                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">
                            Status Pekerjaan
                        </label>

                        <select name="status" class="form-select">

                            <option value="">Semua Status</option>

                            <option value="Bekerja"
                                <?= $status=='Bekerja' ? 'selected' : '' ?>>
                                Bekerja
                            </option>

                            <option value="Wirausaha"
                                <?= $status=='Wirausaha' ? 'selected' : '' ?>>
                                Wirausaha
                            </option>

                            <option value="Studi Lanjut"
                                <?= $status=='Studi Lanjut' ? 'selected' : '' ?>>
                                Studi Lanjut
                            </option>

                            <option value="Belum Bekerja"
                                <?= $status=='Belum Bekerja' ? 'selected' : '' ?>>
                                Belum Bekerja
                            </option>

                        </select>
                    </div>

                    <div class="col-lg-2 d-flex align-items-end">

                        <div class="w-100">
                            <button type="submit" class="btn btn-main w-100 mb-2">
                                <i class="bi bi-funnel me-2"></i>
                                Filter
                            </button>

                            <a href="alumni.php" class="btn btn-secondary w-100">
                                Reset
                            </a>
                        </div>

                    </div>

                </div>

            </form>

        </section>

        <section class="content-card">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                <h2 class="card-heading mb-0">
                    Daftar Alumni
                </h2>

                <span class="text-muted small">
                    Menampilkan <?= $total_data ?> data alumni
                </span>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Alumni</th>
                            <th>Prodi</th>
                            <th>Tahun Lulus</th>
                            <th>IPK</th>
                            <th>Status</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    if(mysqli_num_rows($query) > 0):

                    while($data = mysqli_fetch_assoc($query)):
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= htmlspecialchars($data['nim']); ?></td>

                        <td>
                            <strong>
                                <?= htmlspecialchars($data['nama_lengkap']); ?>
                            </strong>

                            <div class="text-muted small">
                                <?= htmlspecialchars($data['email']); ?>
                            </div>
                        </td>

                        <td><?= htmlspecialchars($data['program_studi']); ?></td>

                        <td><?= htmlspecialchars($data['tahun_lulus']); ?></td>

                        <td><?= htmlspecialchars($data['ipk']); ?></td>

                        <td>

                            <?php
                            if($data['status_pekerjaan']=="Bekerja"){
                                echo '<span class="badge-status badge-bekerja">Bekerja</span>';
                            }
                            elseif($data['status_pekerjaan']=="Wirausaha"){
                                echo '<span class="badge-status badge-wirausaha">Wirausaha</span>';
                            }
                            elseif($data['status_pekerjaan']=="Studi Lanjut"){
                                echo '<span class="badge-status badge-studi">Studi Lanjut</span>';
                            }
                            else{
                                echo '<span class="badge-status badge-belum">Belum Bekerja</span>';
                            }
                            ?>

                        </td>

                        <td><?= htmlspecialchars($data['no_hp']); ?></td>

                        <td>

                            <div class="action-buttons">

                                <a
                                    href="edit-alumni.php?id=<?= $data['id_alumni']; ?>"
                                    class="btn btn-sm btn-warning"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a
                                    href="hapus-alumni.php?id=<?= $data['id_alumni']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                >
                                    <i class="bi bi-trash"></i>
                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php
                    endwhile;
                    else:
                    ?>

                    <tr>
                        <td colspan="9" class="text-center">
                            Data alumni tidak ditemukan
                        </td>
                    </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </section>

        <p class="footer-note">
            Sistem Pengelolaan Data Alumni
        </p>

    </main>

</div>

</body>
</html>