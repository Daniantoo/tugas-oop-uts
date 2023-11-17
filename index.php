<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Sembako</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            max-width: 50px;
            max-height: 50px;
            border-radius: 50%;
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

        .mt-4 {
            text-align: center;
        }
    </style>
    
</head>
<body>
    <h1 class="mt-4">Aplikasi Database Sembako</h1>
    <?php
    require_once 'barang.php';

    $barang = new Barang();

    // Fungsi untuk menambah barang
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $foto = $_FILES['foto']['name'];
        $foto_temp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($foto_temp, 'uploads/' . $foto);

        $barang->tambahBarang($nama, $harga, $stok, $foto);
    }

    // Fungsi untuk menghapus barang
    if (isset($_GET['delete'])) {
        $id_delete = $_GET['delete'];
        $barang->hapusBarang($id_delete);
        header("Location: index.php");
        exit();
    }

    // Fungsi untuk mengambil daftar barang
    $data_barang = $barang->ambilSemuaBarang();
    ?>

    <div class="container">
        <h2>Daftar Barang</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_barang as $barang) : ?>
                    <tr>
                        <td><?= $barang['id']; ?></td>
                        <td><?= $barang['nama_barang']; ?></td>
                        <td><?= $barang['harga']; ?></td>
                        <td><?= $barang['stok']; ?></td>
                        <td><img src="uploads/<?= $barang['foto_barang']; ?>" alt="<?= $barang['nama_barang']; ?>"></td>
                        <td>
                            <a href="edit.php?id=<?= $barang['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?delete=<?= $barang['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Tambah Barang</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Barang:</label>
                <input type="text" class="form-control" name="nama" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" class="form-control" name="harga" required>
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="text" class="form-control" name="stok" required>
            </div>

            <div class="form-group">
                <label for="foto">Foto Barang:</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
