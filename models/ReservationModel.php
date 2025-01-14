<?php

class ReservationModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'fujiyama');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function saveReservation($fullName, $email, $phone, $attendance) {
        // SQL untuk menyimpan data ke dalam database
        $stmt = $this->db->prepare("INSERT INTO reservasi (nama_lengkap, email, nomor_telepon, attendance, tanggal_reservasi) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $fullName, $email, $phone, $attendance);

        // Eksekusi dan cek hasilnya
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Periksa apakah data untuk konfirmasi ulang sudah valid
    public function updateConfirmation($email, $phone, $attendance) {
        // Ubah validasi nilai attendance sesuai dengan yang ada di database
        $validAttendance = ['hadir', 'tidak_hadir']; // Array nilai valid
    
        // Pastikan nilai yang diterima adalah salah satu dari yang valid
        if (!in_array($attendance, $validAttendance)) {
            throw new Exception("Pilihan kehadiran tidak valid. Pilih antara 'hadir' atau 'tidak_hadir'.");
        }
    
        // Lakukan update konfirmasi kehadiran pada database
        $sql = "UPDATE reservasi SET konfirmasi_ulang = ? WHERE email = ? AND nomor_telepon = ?";
        $stmt = $this->db->prepare($sql);
    
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->db->error);
        }
    
        $stmt->bind_param("sss", $attendance, $email, $phone);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true; // Data berhasil diupdate
            } else {
                throw new Exception("Tidak ada data yang diperbarui. Pastikan email dan nomor telepon sesuai.");
            }
        } else {
            throw new Exception("Gagal memperbarui konfirmasi: " . $stmt->error);
        }
    }    
    

    public function checkConfirmationStatus($email, $phone) {
        $query = "SELECT konfirmasi_ulang FROM reservasi WHERE email = ? OR nomor_telepon = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $stmt->bind_result($konfirmasiUlang);
        $stmt->fetch();
    
        // Cek jika konfirmasi_ulang kosong, maka kembalikan 'belum'
        if (empty($konfirmasiUlang)) {
            return 'belum';
        }
    
        return $konfirmasiUlang;
    }
    
}
?>
