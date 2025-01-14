<?php
require_once '../models/ReservationModel.php'; // Make sure the path to your model is correct

class ReservationController {
    private $reservationModel;

    public function __construct() {
        // Menginisialisasi ReservationModel
        require_once '../models/ReservationModel.php';
        $this->reservationModel = new ReservationModel();
    }

    public function handleReservationForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $attendance = $_POST['attendance'];
    
            // Validasi email dan nomor telepon
            if (!ctype_digit($phone)) {
                $_SESSION['error_message'] = 'Nomor telepon harus berisi angka saja.';
                return;
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = 'Email tidak valid. Mohon masukkan email yang benar.';
                return;
            }
    
            // Periksa apakah data sudah ada di database
            $existingReservation = $this->reservationModel->checkExistingReservation($email, $phone);
            if ($existingReservation) {
                $_SESSION['error_message'] = 'Data sudah ada. Email atau nomor telepon sudah terdaftar.';
                return;
            }
    
            // Jika semua validasi berhasil, simpan data ke database
            $this->reservationModel->saveReservation($fullName, $email, $phone, $attendance);
    
            // Jika berhasil, berikan pesan sukses
            $_SESSION['success_message'] = 'Reservasi berhasil!';
        }
    }
    
    
    
    public function handleConfirmationForm() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data konfirmasi ulang
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $attendance = $_POST['attendance'];

            // Pastikan nilai konfirmasi ulang valid
            try {
                $this->reservationModel->updateConfirmation($email, $phone, $attendance);
            } catch (Exception $e) {
            }
        }
    }
}
?>
