<?php

session_start();

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_alumni"
);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );

    $password = mysqli_real_escape_string(
        $conn,
        $_POST['password']
    );

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
        WHERE username='$username'
        AND password='$password'
        AND status='aktif'"
    );

    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['role'] = $data['role'];

        header("Location: dashboard.php");
        exit;

    } else {

        $error = "Username atau Password Salah!";

    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Data Alumni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
     <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<main class="login-page">

    <section class="login-card">

        <div class="login-logo">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <h1 class="h3 fw-bold mb-2">
            Sistem Data Alumni
        </h1>

        <p class="text-muted mb-4">
            Silakan login untuk mengakses dashboard
        </p>

        <?php if(isset($error)) : ?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <div class="form-check mb-3">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="showPassword"
                >

                <label
                    class="form-check-label"
                    for="showPassword"
                >
                    Tampilkan Password
                </label>
            </div>

            <button
                type="submit"
                name="login"
                class="btn btn-main w-100"
            >
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Login
            </button>

        </form>

    </section>

</main>

<script>
document
.getElementById("showPassword")
.addEventListener("change", function () {

    let password =
        document.querySelector(
            'input[name="password"]'
        );

    if (this.checked) {
        password.type = "text";
    } else {
        password.type = "password";
    }

});
</script>

</body>
</html>