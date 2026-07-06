```php
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

$data = mysqli_query(
    $conn,
    "SELECT * FROM alumni WHERE id_alumni='$id'"
);

$alumni = mysqli_fetch_assoc($data);

if (!$alumni) {
    echo "Data alumni tidak ditemukan";
    exit;
}

if (isset($_POST['update'])) {

    $nim = $_POST['nim'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $program_studi = $_POST['program_studi'];
    $fakultas = $_POST['fakultas'];
    $tahun_masuk = $_POST['tahun_masuk'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $ipk = $_POST['ipk'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $status_pekerjaan = $_POST['status_pekerjaan'];

    $update = mysqli_query(
        $conn,
        "UPDATE alumni SET
            nim='$nim',
            nama_lengkap='$nama_lengkap',
            jenis_kelamin='$jenis_kelamin',
            tempat_lahir='$tempat_lahir',
            tanggal_lahir='$tanggal_lahir',
            program_studi='$program_studi',
            fakultas='$fakultas',
            tahun_masuk='$tahun_masuk',
            tahun_lulus='$tahun_lulus',
            ipk='$ipk',
            email='$email',
            no_hp='$no_hp',
            alamat='$alamat',
            status_pekerjaan='$status_pekerjaan'
        WHERE id_alumni='$id'"
    );

    if ($update) {
        echo "<script>
                alert('Data berhasil diperbarui');
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
    <title>Edit Alumni | Sistem Data Alumni</title>

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
                <h1 class="page-title">Edit Alumni</h1>
                <p class="page-subtitle">
                    Perbarui data alumni yang sudah tersimpan.
                </p>
            </div>

            <a href="alumni.php" class="btn btn-soft">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <section class="content-card">

            <h2 class="card-heading">Form Edit Data Alumni</h2>

            <form method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control"
                               value="<?= $alumni['nim']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"
                               value="<?= $alumni['nama_lengkap']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>

                        <select name="jenis_kelamin" class="form-select">

                            <option value="Laki-laki"
                            <?= $alumni['jenis_kelamin']=='Laki-laki' ? 'selected' : '' ?>>
                                Laki-laki
                            </option>

                            <option value="Perempuan"
                            <?= $alumni['jenis_kelamin']=='Perempuan' ? 'selected' : '' ?>>
                                Perempuan
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                               value="<?= $alumni['tempat_lahir']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                               value="<?= $alumni['tanggal_lahir']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Program Studi</label>
                        <input type="text" name="program_studi" class="form-control"
                               value="<?= $alumni['program_studi']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Fakultas</label>
                        <input type="text" name="fakultas" class="form-control"
                               value="<?= $alumni['fakultas']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tahun Masuk</label>
                        <input type="number" name="tahun_masuk" class="form-control"
                               value="<?= $alumni['tahun_masuk']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus" class="form-control"
                               value="<?= $alumni['tahun_lulus']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">IPK</label>
                        <input type="number" step="0.01" name="ipk" class="form-control"
                               value="<?= $alumni['ipk']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status Pekerjaan</label>

                        <select name="status_pekerjaan" class="form-select">

                            <option value="Bekerja" <?= $alumni['status_pekerjaan']=='Bekerja' ? 'selected' : '' ?>>Bekerja</option>

                            <option value="Wirausaha" <?= $alumni['status_pekerjaan']=='Wirausaha' ? 'selected' : '' ?>>Wirausaha</option>

                            <option value="Studi Lanjut" <?= $alumni['status_pekerjaan']=='Studi Lanjut' ? 'selected' : '' ?>>Studi Lanjut</option>

                            <option value="Belum Bekerja" <?= $alumni['status_pekerjaan']=='Belum Bekerja' ? 'selected' : '' ?>>Belum Bekerja</option>

                        </select>

                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= $alumni['email']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control"
                               value="<?= $alumni['no_hp']; ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Alamat</label>

                        <textarea name="alamat" class="form-control" rows="3"><?= $alumni['alamat']; ?></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">

                    <a href="alumni.php" class="btn btn-soft">
                        Batal
                    </a>

                    <button type="submit" name="update" class="btn btn-main">
                        <i class="bi bi-save me-2"></i>Update Data
                    </button>

                </div>

            </form>

        </section>

        <p class="footer-note">Sistem Pengelolaan Data Alumni</p>

    </main>

</div>

</body>
</html>
```
