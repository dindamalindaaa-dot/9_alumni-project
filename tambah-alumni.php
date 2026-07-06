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

if(isset($_POST['simpan'])){

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

    $query = mysqli_query(
        $conn,
        "INSERT INTO alumni(
            nim,
            nama_lengkap,
            jenis_kelamin,
            tempat_lahir,
            tanggal_lahir,
            program_studi,
            fakultas,
            tahun_masuk,
            tahun_lulus,
            ipk,
            email,
            no_hp,
            alamat,
            status_pekerjaan
        ) VALUES (
            '$nim',
            '$nama_lengkap',
            '$jenis_kelamin',
            '$tempat_lahir',
            '$tanggal_lahir',
            '$program_studi',
            '$fakultas',
            '$tahun_masuk',
            '$tahun_lulus',
            '$ipk',
            '$email',
            '$no_hp',
            '$alamat',
            '$status_pekerjaan'
        )"
    );

    if($query){
        echo "<script>
                alert('Data alumni berhasil ditambahkan');
                window.location='alumni.php';
              </script>";
        exit;
    }else{
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alumni | Sistem Data Alumni</title>

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
                <a href="tambah-alumni.php" class="active">
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
                <h1 class="page-title">Tambah Alumni</h1>
                <p class="page-subtitle">
                    Lengkapi form berikut untuk menambahkan data alumni baru.
                </p>
            </div>

            <a href="alumni.php" class="btn btn-soft">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <section class="content-card">

            <h2 class="card-heading">Form Data Alumni</h2>

            <form method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Contoh: 190101001" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Contoh: Banda Aceh">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Program Studi</label>
                        <input type="text" name="program_studi" class="form-control" placeholder="Contoh: Pendidikan Teknologi Informasi">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Fakultas</label>
                        <input type="text" name="fakultas" class="form-control" placeholder="Contoh: Tarbiyah dan Keguruan">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tahun Masuk</label>
                        <input type="number" name="tahun_masuk" class="form-control" placeholder="2019">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus" class="form-control" placeholder="2023">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">IPK</label>
                        <input type="number" step="0.01" name="ipk" class="form-control" placeholder="3.75">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status Pekerjaan</label>
                        <select name="status_pekerjaan" class="form-select">
                            <option value="Belum Bekerja">Belum Bekerja</option>
                            <option value="Bekerja">Bekerja</option>
                            <option value="Wirausaha">Wirausaha</option>
                            <option value="Studi Lanjut">Studi Lanjut</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat alumni"></textarea>
                    </div>

                </div>

                <hr class="my-4">

                <h2 class="card-heading">Data Pekerjaan Opsional</h2>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Instansi</label>
                        <input type="text" class="form-control" placeholder="Contoh: PT Digital Nusantara">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Web Developer">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Bidang Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Teknologi Informasi">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Lokasi Kerja</label>
                        <input type="text" class="form-control" placeholder="Contoh: Banda Aceh">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Penghasilan</label>
                        <select class="form-select">
                            <option value="">Pilih rentang penghasilan</option>
                            <option>&lt; 2 Juta</option>
                            <option>2-5 Juta</option>
                            <option>5-10 Juta</option>
                            <option>&gt; 10 Juta</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tahun Mulai Kerja</label>
                        <input type="number" class="form-control" placeholder="2023">
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">

                    <a href="alumni.php" class="btn btn-soft">
                        Batal
                    </a>

                    <button type="submit" name="simpan" class="btn btn-main">
                        <i class="bi bi-save me-2"></i>Simpan Data
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
