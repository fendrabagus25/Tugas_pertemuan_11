<?php 
include("koneksi.php"); 
// query untuk menampilkan data 
$sql = 'SELECT * FROM data_barang'; 
$result = mysqli_query($conn, $sql); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <style>
    /* Resetting the default margin and padding for all elements */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Styling for the container */
    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    /* Styling for the page title */
    h1 {
        text-align: left;
        margin-bottom: 20px;
        font-size: 4rem;
        color: #333;
    }

    /* Styling for the add new button */
    a input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        text-align: center;
        margin-bottom: 20px;
        font-size: 1rem;
        border-radius: 5px;
    }

    a input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Styling for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    /* Styling for the table header */
    th {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    /* Styling for the table cells */
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    /* Styling for the image in the table */
    td img {
        width: 50px;
        height: auto;
        border-radius: 5px;
    }

    /* Row hover effect */
    tr:hover {
        background-color: #f5f5f5;
    }

    /* Styling for the add new button (Tambah Baru) */
    a input[type="submit"].tambah {
        padding: 10px 20px;
        background-color: #007BFF;
        /* Blue color */
        color: white;
        border: none;
        cursor: pointer;
        text-align: center;
        margin-bottom: 20px;
        font-size: 1rem;
        border-radius: 5px;
    }

    a input[type="submit"].tambah:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }

    /* Styling for the table action buttons (Ubah, Hapus) */
    input[type="submit"].ubah {
        padding: 10px 15px;
        background-color: #007BFF;
        /* Blue color (for Ubah) */
        color: white;
        border: none;
        cursor: pointer;
        text-align: center;
        font-size: 0.9rem;
        border-radius: 5px;
    }

    input[type="submit"].ubah:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }

    input[type="submit"].hapus {
        padding: 10px 15px;
        background-color: #dc3545;
        /* Red color (for Hapus) */
        color: white;
        border: none;
        cursor: pointer;
        /* text-align: center; */
        font-size: 0.9rem;
        border-radius: 5px;
    }

    input[type="submit"].hapus:hover {
        background-color: #c82333;
        /* Darker red on hover */
    }

    /* Centering the action buttons (Ubah, Hapus) */
    td.actions {
        text-align: center;
        /* Centers the buttons horizontally */
    }

    /* Making the table responsive for smaller screens */
    @media screen and (max-width: 768px) {

        table,
        th,
        td {
            display: block;
            width: 100%;
        }

        th,
        td {
            text-align: right;
            padding: 10px;
        }

        th {
            background-color: #f1f1f1;
            color: #333;
        }

        td {
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        td:before {
            content: attr(data-label);
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Barang</h1>
        <a href="tambah.php"><input type="submit" alt="submit" value="Tambah Baru"></a>
        <div class="main">
            <table>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Katagori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
                <?php if($result): ?>
                <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><img src="<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>" width="50"></td>
                    <td><?= $row['nama'];?></td>
                    <td><?= $row['katagori'];?></td>
                    <td><?= $row['harga_beli'];?></td>
                    <td><?= $row['harga_jual'];?></td>
                    <td><?= $row['stok'];?></td>
                    <td class="actions">
                        <a href="ubah.php?id=<?= $row['id_barang']; ?>"><input type="submit" class="ubah"
                                value="Ubah" /></a>
                        <a href="hapus.php?id=<?= $row['id_barang']; ?>"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><input type="submit"
                                class="hapus" value="Hapus" /></a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr>
                    <td colspan="7">Belum ada data</td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>

</html>