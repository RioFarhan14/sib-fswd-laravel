<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'arkatama_pertemuan13';
$koneksi = mysqli_connect($host, $username, $password, $database);

if (isset($_POST['submit'])) {
    // Mengambil nilai dari form
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($file_tmp, 'uploads/' . $foto);
    // Mengambil nama file foto

    // Memeriksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi ke database gagal: " . $koneksi->connect_error);
    }


    // Memasukkan data ke tabel users
    $sql = "INSERT INTO users (name, role, password, email, phone, address,foto, created_at,updated_at) 
        VALUES ('$nama', '$role', '$password', '$email', '$telp', '$alamat','$foto',NOW(),NOW())";
    if ($koneksi->query($sql) === TRUE) {
        echo "Data users berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    $koneksi->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .password-toggle {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .password-toggle input[type="checkbox"] {
            margin-right: 5px;
        }

        .password-toggle label {
            margin-bottom: 0;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
        }

        .form-row .form-col {
            flex: 1;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 3px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .lihat {
            display: flex;
            margin-top: -10px;
            border-radius: 5px;
            width: max-content;
            height: max-content;
            background-color: aqua;
            padding: 10px;
        }
    </style>
</head>

<body>
    <a href="/">Kembali</a>
    <h2>Form Tambah users</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" placeholder="Nama Lengkap" required>

        <div class="form-row">
            <div class="form-col">
                <label for="role">Role:</label>
                <select name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="Admin">Admin</option>
                    <option value="staff">staff</option>
                </select>
            </div>
            <div class="form-col">
                <label for="password">Password:</label>
                <div class="password-toggle">
                    <input type="password" id="password" name="password" required>
                    <input type="checkbox" id="show_password" hidden onclick="togglePasswordVisibility()">
                    <label for="show_password"><span class="lihat">Lihat</span></label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="name@example" required>
            </div>
            <div class="form-col">
                <label for="telp">Telepon:</label>
                <input type="tel" name="telp" required>
            </div>
        </div>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required rows="5"></textarea>

        <label for="foto">Foto:</label>
        <input type="file" name="foto">

        <input type="submit" name="submit">
    </form>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var showPasswordCheckbox = document.getElementById("show_password");

            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>

</html>