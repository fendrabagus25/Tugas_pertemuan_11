<?php 
error_reporting(E_ALL); 
include_once 'koneksi.php'; 

if (isset($_POST['submit'])) { 
    // Mengambil data dari form
    $nama = $_POST['nama']; 
    $katagori = $_POST['katagori']; 
    $harga_jual = $_POST['harga_jual']; 
    $harga_beli = $_POST['harga_beli']; 
    $stok = $_POST['stok']; 

    // Mengambil file gambar
    $foto = $_FILES['file_gambar']; 
    $gambar = null; 

    // Memeriksa apakah ada file gambar yang diupload
    if ($foto['error'] == 0) { 
        // Menangani nama file agar tidak ada spasi
        $filename = str_replace(' ', '_', $foto['name']); 

        // Menentukan folder tujuan untuk menyimpan gambar
        $destination = dirname(__FILE__) . $filename; 

        // Memindahkan file gambar ke folder tujuan
        if (move_uploaded_file($foto['tmp_name'], $destination)) { 
            // Menyimpan path gambar ke dalam variabel $gambar
            $gambar = $filename; 
        } else {
            // Menampilkan error jika gagal mengunggah gambar
            echo "Error: Gagal mengunggah gambar.";
        }
    }

    // Memeriksa jika gambar berhasil diunggah
    if ($gambar) {
        // Menyusun query SQL untuk memasukkan data barang ke dalam database
        $sql = "INSERT INTO data_barang (nama, katagori, harga_jual, harga_beli, stok, gambar) ";
        $sql .= "VALUES ('{$nama}', '{$katagori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";

        // Menjalankan query
        $result = mysqli_query($conn, $sql);

        // Mengecek apakah query berhasil
        if ($result) {
            // Jika berhasil, redirect ke halaman index.php
            header('Location: index.php');
            exit();
        } else {
            // Menampilkan error jika query gagal
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Gambar tidak ditemukan atau gagal diupload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <style>
    /* Reset default margin and padding for all elements */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Styling for the container */
    .container {
        width: 90%;
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        font-family: 'Arial', sans-serif;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Styling for the page title */
    h1 {
        text-align: center;
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 20px;
    }

    /* Styling for the form container */
    .main {
        padding: 20px;
    }

    /* Styling for each form input container */
    .input {
        margin-bottom: 20px;
    }

    /* Styling for form labels */
    .input label {
        display: block;
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 8px;
    }

    /* Styling for text and select inputs */
    .input input[type="text"],
    .input select,
    .input input[type="file"] {
        width: 100%;
        padding: 12px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        transition: all 0.3s ease-in-out;
    }

    /* Focus styles for input fields */
    .input input[type="text"]:focus,
    .input select:focus,
    .input input[type="file"]:focus {
        border-color: #007BFF;
        /* Blue color for focus */
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Styling for submit button */
    .submit input[type="submit"] {
        width: 100%;
        padding: 15px;
        background-color: #28a745;
        /* Green color */
        color: white;
        font-size: 1.2rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit input[type="submit"]:hover {
        background-color: #218838;
        /* Darker green on hover */
    }

    /* Styling for input fields when hovering */
    .input input[type="text"]:hover,
    .input select:hover,
    .input input[type="file"]:hover {
        background-color: #f1f1f1;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        .container {
            width: 95%;
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
        }

        .input input[type="text"],
        .input select,
        .input input[type="file"],
        .submit input[type="submit"] {
            font-size: 1rem;
            padding: 10px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Barang</h1>
        <div class="main">
            <form method="post" action="tambah.php" enctype="multipart/form-data">
                <div class="input">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" />
                </div>
                <div class="input">
                    <label>Kategori</label>
                    <select name="katagori">
                        <option value="Komputer">Komputer</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Handphone">Handphone</option>
                    </select>
                </div>
                <div class="input">
                    <label>Harga Beli</label>
                    <input type="text" name="harga_beli" />
                </div>
                <div class="input">
                    <label>Harga Jual</label>
                    <input type="text" name="harga_jual" />
                </div>
                <div class="input">
                    <label>Stok</label>
                    <input type="text" name="stok" />
                </div>
                <div class="input">
                    <label>File Gambar</label>
                    <input type="file" name="file_gambar" />
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>