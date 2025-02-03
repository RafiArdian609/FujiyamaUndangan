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
        // Cek apakah email atau nomor telepon sudah ada di database
        if ($this->isDuplicate($email, $phone)) {
            echo "<script>alert('Data dengan email atau nomor telepon ini sudah ada. Silakan gunakan yang lain.');</script>";
            return false;
        }
    
        // SQL untuk menyimpan data ke dalam database
        $stmt = $this->db->prepare("INSERT INTO reservasi (nama_lengkap, email, nomor_telepon, attendance, tanggal_reservasi) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $fullName, $email, $phone, $attendance);
    
        // Eksekusi dan cek hasilnya
        if ($stmt->execute()) {
            return true;
        } else {
            echo "<script>alert('Gagal menyimpan data reservasi.');</script>";
            return false;
        }
    }
    
    public function isDuplicate($email, $phone) {
        // Query untuk memeriksa apakah email atau nomor telepon sudah ada
        $query = "SELECT COUNT(*) FROM reservasi WHERE email = ? OR nomor_telepon = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        
        return $count > 0; // Jika count > 0 berarti ada duplikasi
    }    
    

    // Periksa apakah data untuk konfirmasi ulang sudah valid
    public function updateConfirmation($id, $attendance) {
        // Validasi nilai attendance sesuai database
        $validAttendance = ['hadir', 'tidak_hadir']; // Nilai valid
    
        // Pastikan nilai yang diterima adalah salah satu dari yang valid
        if (!in_array($attendance, $validAttendance)) {
            throw new Exception("Pilihan kehadiran tidak valid. Pilih antara 'hadir' atau 'tidak_hadir'.");
        }
    
        // Update atribut konfirmasi_ulang berdasarkan ID
        $sql = "UPDATE reservasi SET konfirmasi_ulang = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
    
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->db->error);
        }
    
        $stmt->bind_param("si", $attendance, $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true; // Data berhasil diperbarui
            } else {
                throw new Exception("Tidak ada data yang diperbarui. Pastikan ID sesuai.");
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

    public function checkExistingReservation($email, $phone) {
        $query = "SELECT * FROM reservasi WHERE email = ? OR nomor_telepon = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            return true;  // Data sudah ada
        }
        return false; // Data tidak ada
    }    

    public function getNamaById($id) {
        $query = "SELECT nama_lengkap FROM reservasi WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($nama);
        $stmt->fetch();
        return $nama ?? 'Tamu'; // Jika nama tidak ditemukan, kembalikan 'Tamu'
    }

    public function updateAttendance($id, $attendance) {
        $query = "UPDATE reservasi SET attendance = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $attendance, $id);
        return $stmt->execute();
    }

    public function getInstansiById($id) {
        $query = "SELECT instansi FROM reservasi WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($instansi);
        $stmt->fetch();
        return $instansi ?? 'Tidak Diketahui'; // Default jika instansi tidak ditemukan
    }
    
    
}
?>
