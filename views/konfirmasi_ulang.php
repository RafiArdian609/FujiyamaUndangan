<?php
require_once '../controllers/ReservationController.php'; // Pastikan path ke controller benar

// Membuat instance dari controller
$reservationController = new ReservationController();

// Menangani form untuk konfirmasi ulang
$reservationController->handleConfirmationForm();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Konfirmasi Reservasi</title>
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
        .copyright a {
            color: #F28B82;
            font-weight: 700;
        }

        .copyright a:hover {
            color: #FF69B4;
        }
    </style>
</head>
<body>
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Konfirmasi Ulang Reservasi Fujiyama Restaurant</p>
						<h1>Pastikan Reservasi Anda Tersimpan dengan Benar</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2>Konfirmasi Ulang Reservasi</h2>
						<p>Masukkan data dengan benar untuk konfirmasi ulang reservasi Anda di Fujiyama Restaurant!</p>
					</div>
				 	<div id="form_status"></div>
					 	<div class="contact-form">
							<form method="POST" action="konfirmasi_ulang.php">
                                <p>
                                    <input type="text" placeholder="Nama Lengkap" name="full_name" id="full_name" required>
                                    <input type="email" placeholder="Email" name="email" id="email" required>
                                </p>
                                <p>
                                    <input type="tel" placeholder="Nomor Telepon" name="phone" id="phone" pattern="\d+" title="Hanya angka yang diperbolehkan" required>
                                    <select name="attendance" id="attendance" required>
                                        <option value="hadir">Hadir</option>
                                        <option value="tidak_hadir">Tidak Hadir</option>
                                    </select>
                                </p>
								<p><input type="submit" value="Konfirmasi Ulang"></p>
							</form>
						</div>
					</div>
				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-map"></i> Alamat Restoran</h4>
							<p>34/8, East Hukupara <br> Gifirtok, Sadan. <br> Country Name</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> Jam Buka</h4>
							<p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> Kontak</h4>
							<p>Phone: +00 111 222 3333 <br> Email: support@fruitkha.com</p>
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
