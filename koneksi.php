<?php
class Koneksi
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "sembako";

    protected $koneksi;

    public function __construct()
    {
        $this->koneksi = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->koneksi->connect_error) {
            die("Koneksi database gagal: " . $this->koneksi->connect_error);
        }
    }
}
?>
