<?php
require_once '../models/ReservationModel.php';

class ReservationController {
    private $reservationModel;

    public function __construct() {
        $this->reservationModel = new ReservationModel();
    }

    public function handleReservationForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $attendance = $_POST['attendance'] ?? null;
            $nama = $_POST['nama'] ?? null; // Ambil nama dari form
    
            if (!$attendance || !in_array($attendance, ['hadir', 'tidak_hadir'])) {
                $_SESSION['error_message'] = 'Pilihan kehadiran tidak valid.';
                return false;
            }
    
            if (!$nama) {
                $_SESSION['error_message'] = 'Nama tidak valid.';
                return false;
            }
    
            $success = $this->reservationModel->updateAttendanceByName($nama, $attendance);
            if ($success) {
                $_SESSION['success_message'] = 'Konfirmasi kehadiran berhasil!';
                return true;
            } else {
                $_SESSION['error_message'] = 'Gagal menyimpan konfirmasi kehadiran.';
                return false;
            }
        }
    }
    

    public function getUserDataByName($name) {
        return $this->reservationModel->getUserByName($name);
    }
}

?>
