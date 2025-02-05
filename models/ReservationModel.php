<?php

class ReservationModel
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'fujiyama');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function updateAttendanceByName($nama, $attendance)
    {
        $query = "UPDATE reservasi SET attendance = ? WHERE nama_lengkap = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $attendance, $nama);
        return $stmt->execute();
    }


    public function getUserByName($name)
    {
        $query = "SELECT id, instansi FROM reservasi WHERE nama_lengkap = ?";
        $stmt = $this->db->prepare($query);

        if (!$stmt) {
            throw new Exception("Error preparing query: " . $this->db->error);
        }

        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Mengembalikan data user yang lebih lengkap
        } else {
            return ['id' => null, 'instansi' => null]; // Jika nama tidak ditemukan
        }
    }
}
