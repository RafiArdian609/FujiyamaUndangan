<?php
session_start();
require_once '../controllers/ReservationController.php'; // Sesuaikan path sesuai struktur folder Anda

$controller = new ReservationController();

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
$nama = "Tamu"; // Default nama jika ID tidak ditemukan

if ($id) {
    // Ambil nama dari database berdasarkan ID
    $nama = $controller->getNamaById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->handleReservationForm();
    header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id); // Pertahankan ID di URL setelah submit
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Kehadiran</title>
    <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <style>

        .breadcrumb-text p {
        color: #FF69B4;
        }

        .copyright a {
            color: #FF69B4;
            font-weight: 700;
        }

        .contact-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-form input[type="submit"] {
            background-color: #FF69B4;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .form-title h2 {
            color: #FF69B4;
        }

        .welcome-message {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
        }

        .google-maps {
            margin-top: 20px; /* Jarak dari bagian kontak di atas */
            border-radius: 10px; /* Sudut melengkung */
            overflow: hidden; /* Pastikan iframe tidak keluar dari container */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }

        .google-maps iframe {
            width: 100%; /* Lebar penuh */
            height: 300px; /* Tinggi iframe */
            border: 0; /* Hilangkan border */
        }
        
        .contact-form form p select {
            width: 49%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        @media (max-width: 768px) {
            .contact-form form p select {
                width: 100%; /* Lebar penuh di perangkat mobile */
            }
        }
    </style>
</head>
<body>
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Undangan Sakura Matsuri</p>
                        <h1>Mari Rayakan Keindahan Sakura Bersama!</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Kami Mengundang Bapak/Ibu <span> <?php echo htmlspecialchars($nama); ?>! </span> untuk Merayakan Sakura Matsuri! </h2>
                        <p>Kami dengan senang hati mengundang Bapak/Ibu untuk bergabung dalam perayaan Sakura Matsuri di Fujiyama Restaurant. Nikmati suasana sakura yang memukau, hidangan lezat khas Jepang, dan momen spesial bersama kami.</p>
                    </div>


                    <div id="errorMessage" style="color: red; margin-bottom: 10px;">
                        <?php
                        if (isset($_SESSION['error_message'])) {
                            echo $_SESSION['error_message'];
                            unset($_SESSION['error_message']);
                        }
                        ?>
                    </div>

                    <div id="successMessage" style="color: green; margin-bottom: 10px;">
                        <?php
                        if (isset($_SESSION['success_message'])) {
                            echo $_SESSION['success_message'];
                            unset($_SESSION['success_message']);
                        }
                        ?>
                    </div>

                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="">
                            <p>
                                <select name="attendance" id="attendance" required>
                                    <option value="" disabled selected>Pilih Konfirmasi Kehadiran</option>
                                    <option value="hadir">Ya, Saya Akan Hadir   </option>
                                    <option value="tidak_hadir">Maaf, Saya Tidak Bisa Hadir</option>
                                </select>
                            </p>
                            <p><input type="submit" value="Konfirmasi Sekarang"></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-wrap">
                        <div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> Alamat Restoran</h4>
                            Jl. Nginden Semolo No.44, Surabaya<br>
                            (Bertempat di Lobby Sekolah)
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> Jam Buka / <br> Registrasi Tamu</h4>
                            <p>Kamis, 6 Februari: <br> 9.30 - 10.00 (Registrasi Tamu)</p>
                        </div>
                        <!-- <div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> Kontak</h4>
                            <p>Phone: +00 111 222 3333 <br> Email: support@fruitkha.com</p>
                        </div> -->

                        <div class="google-maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.4797720527345!2d112.7639920768985!3d-7.299869671764745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa5385e1323d%3A0xd34919933df0314!2sSMK%2017%20Agustus%201945%20Surabaya!5e0!3m2!1sen!2sid!4v1738263792376!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2025 - <a href="javascript:void(0);" onclick="location.reload();">Fujiyama Restaurant</a>,  All Rights Reserved.<br>
                        Distributed By - <a href="javascript:void(0);" onclick="location.reload();">Team RPL</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-1.11.3.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.countdown.js"></script>
    <script src="../assets/js/jquery.isotope-3.0.6.min.js"></script>
    <script src="../assets/js/waypoints.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/jquery.meanmenu.min.js"></script>
    <script src="../assets/js/sticker.js"></script>
    <script src="../assets/js/form-validate.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>