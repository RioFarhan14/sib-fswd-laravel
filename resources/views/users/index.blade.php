<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 19</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <button class="button green" onclick="window.location.href='/tambah'">Tambah Pengguna</button>
    <h1>Data Pengguna</h1>
    <?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'arkatama_pertemuan13';
    $koneksi = mysqli_connect($host, $username, $password, $database);

    // Mengecek koneksi
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Mendapatkan data pengguna dari database
    $query = "SELECT * FROM users";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Aksi</th>";
        echo "<th>Avatar</th>";
        echo "<th>Nama</th>";
        echo "<th>Email</th>";
        echo "<th>Phone</th>";
        echo "<th>Role</th>";
        echo "</tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>";
            echo "<a class='button detail' href='/detail?id=" . $row['id'] . "'>Detail</a>";
            echo "<a class='button edit' href='/edit?id=" . $row['id'] . "'>Edit</a>";
            echo "<a class='button delete' href='/delete?id=" . $row['id'] . "'>Hapus</a>";
            echo "</td>";
            echo "<td><ion-icon name='person-circle-outline' size='large'></ion-icon></td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data pengguna.";
    }

    // Menutup koneksi
    mysqli_close($koneksi);
    ?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>