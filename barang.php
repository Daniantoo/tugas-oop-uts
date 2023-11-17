<?php
require_once 'koneksi.php';

class Barang extends Koneksi
{
    public function tambahBarang($nama, $harga, $stok, $foto)
    {
        $nama = $this->koneksi->real_escape_string($nama);
        $harga = intval($harga);
        $stok = intval($stok);

        $query = "INSERT INTO barang (nama_barang, harga, stok, foto_barang) VALUES ('$nama', $harga, $stok, '$foto')";
        $result = $this->koneksi->query($query);

        return $result;
    }

    public function ambilSemuaBarang()
    {
        $query = "SELECT * FROM barang";
        $result = $this->koneksi->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function ambilBarangById($id)
    {
        $id = intval($id);

        $query = "SELECT * FROM barang WHERE id = $id";
        $result = $this->koneksi->query($query);

        $data = $result->fetch_assoc();

        return $data;
    }

    public function updateBarang($id, $nama, $harga, $stok, $foto)
{
    $id = intval($id);
    $nama = $this->koneksi->real_escape_string($nama);
    $harga = intval($harga);
    $stok = intval($stok);

    $data_barang = $this->ambilBarangById($id);
    $foto_lama = $data_barang['foto_barang'];

    // Periksa apakah ada file gambar baru diunggah
    if (!empty($foto)) {
        // Hapus foto lama dari folder uploads
        $foto_path = 'uploads/' . $foto_lama;
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }

        // Pindahkan file gambar baru ke folder uploads
        move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto);
    } else {
        // Jika tidak ada file baru diunggah, gunakan foto lama
        $foto = $foto_lama;
    }

    // Update data di database
    $query = "UPDATE barang SET nama_barang='$nama', harga=$harga, stok=$stok, foto_barang='$foto' WHERE id=$id";
    $result = $this->koneksi->query($query);

    return $result;
}


    public function hapusBarang($id)
    {
        $id = intval($id);

        $query = "DELETE FROM barang WHERE id=$id";
        $result = $this->koneksi->query($query);

        return $result;
    }
}
?>
