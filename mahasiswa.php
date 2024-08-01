<?php
class Mahasiswa {
    private $conn;
    private $table_name = "mahasiswa";

    public $nim;
    public $nama;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jurusan;
    public $program_studi;
    public $ipk;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET
                    nim=:nim, nama=:nama, tempat_lahir=:tempat_lahir, tanggal_lahir=:tanggal_lahir,
                    jurusan=:jurusan, program_studi=:program_studi, ipk=:ipk";

        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":tempat_lahir", $this->tempat_lahir);
        $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":program_studi", $this->program_studi);
        $stmt->bindParam(":ipk", $this->ipk);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read
    function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update
    function update() {
        $query = "UPDATE " . $this->table_name . " SET
                    nama=:nama, tempat_lahir=:tempat_lahir, tanggal_lahir=:tanggal_lahir,
                    jurusan=:jurusan, program_studi=:program_studi, ipk=:ipk
                  WHERE nim = :nim";

        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":tempat_lahir", $this->tempat_lahir);
        $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":program_studi", $this->program_studi);
        $stmt->bindParam(":ipk", $this->ipk);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE nim = :nim";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nim", $this->nim);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Sanitize inputs
    private function sanitize() {
        $this->nim = htmlspecialchars(strip_tags($this->nim));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->tempat_lahir = htmlspecialchars(strip_tags($this->tempat_lahir));
        $this->tanggal_lahir = htmlspecialchars(strip_tags($this->tanggal_lahir));
        $this->jurusan = htmlspecialchars(strip_tags($this->jurusan));
        $this->program_studi = htmlspecialchars(strip_tags($this->program_studi));
        $this->ipk = htmlspecialchars(strip_tags($this->ipk));
    }
}
?>
