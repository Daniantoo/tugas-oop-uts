<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    require_once 'barang.php';

    $barang = new Barang();

    // Fungsi untuk mengambil data barang berdasarkan ID
    if (isset($_GET['id'])) {
        $id_edit = $_GET['id'];
        $data_edit = $barang->ambilBarangById($id_edit);
    }

    // Fungsi untuk mengupdate barang
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $foto = $_FILES['foto']['name'];
        $foto_temp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($foto_temp, 'uploads/' . $foto);

        $barang->updateBarang($id, $nama, $harga, $stok, $foto);
        header("Location: index.php");
        exit();
    }
    ?>

    <div class="container">
        <h2>Edit Barang</h2>
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data_edit['id']; ?>">

            <div class="form-group">
                <label for="nama">Nama Barang:</label>
                <input type="text" class="form-control" name="nama" value="<?= $data_edit['nama_barang']; ?>" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" class="form-control" name="harga" value="<?= $data_edit['harga']; ?>" required>
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="text" class="form-control" name="stok" value="<?= $data_edit['stok']; ?>" required>
            </div>

            <div class="form-group">
                <label for="foto">Foto Barang:</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
