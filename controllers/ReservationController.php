<?php
require_once '../models/ReservationModel.php'; // Make sure the path to your model is correct

class ReservationController {
    private $reservationModel;

    public function __construct() {
        $this->reservationModel = new ReservationModel();
    }

    public function handleReservationForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $attendance = $_POST['attendance'];

            // Validasi pilihan kehadiran
            if (empty($attendance) || !in_array($attendance, ['hadir', 'tidak_hadir'])) {
                $_SESSION['error_message'] = 'Pilihan kehadiran tidak valid.';
                return;
            }

            // Simpan data ke database
            $id = $_GET['id'] ?? null; // Ambil ID dari URL
            if ($id) {
                $success = $this->reservationModel->updateAttendance($id, $attendance);
                if ($success) {
                    $_SESSION['success_message'] = 'Konfirmasi kehadiran berhasil!';
                } else {
                    $_SESSION['error_message'] = 'Gagal menyimpan konfirmasi kehadiran.';
                }
            } else {
                $_SESSION['error_message'] = 'ID tidak valid.';
            }
        }
    }
    
    public function getNamaById($id) {
        return $this->reservationModel->getNamaById($id);
    }
    
    public function handleConfirmationForm() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data konfirmasi ulang
            $id = $_GET['id'] ?? null; // Ambil ID dari URL
            $attendance = $_POST['attendance'];
    
            if (!$id) {
                throw new Exception("ID tidak ditemukan dalam URL.");
            }
    
            // Pastikan nilai konfirmasi ulang valid
            try {
                $this->reservationModel->updateConfirmation($id, $attendance);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>
