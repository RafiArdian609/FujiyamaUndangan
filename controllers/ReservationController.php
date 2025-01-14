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
            // Capture the form data
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $attendance = $_POST['attendance'];

            // Validate phone number to only contain digits
            if (!ctype_digit($phone)) {
                echo "<div style='color: red;'>Nomor telepon harus berisi angka saja.</div>";
                return; // Stop further processing
            }

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div style='color: red;'>Email tidak valid. Mohon masukkan email yang benar.</div>";
                return; // Stop further processing
            }

            // Save the reservation data to the database using $this->reservationModel
            $this->reservationModel->saveReservation($fullName, $email, $phone, $attendance);
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
