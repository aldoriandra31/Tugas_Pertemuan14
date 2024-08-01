<?php
require_once 'Database.php';
require_once 'Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

// Create
if (isset($_POST['create'])) {
    $mahasiswa->nim = $_POST['nim'];
    $mahasiswa->nama = $_POST['nama'];
    $mahasiswa->tempat_lahir = $_POST['tempat_lahir'];
    $mahasiswa->tanggal_lahir = $_POST['tanggal_lahir'];
    $mahasiswa->jurusan = $_POST['jurusan'];
    $mahasiswa->program_studi = $_POST['program_studi'];
    $mahasiswa->ipk = $_POST['ipk'];
    if ($mahasiswa->create()) {
        echo "Data Mahasiswa berhasil ditambahkan.";
    } else {
        echo "Data Mahasiswa gagal ditambahkan.";
    }
}

// Update
if (isset($_POST['update'])) {
    $mahasiswa->nim = $_POST['nim'];
    $mahasiswa->nama = $_POST['nama'];
    $mahasiswa->tempat_lahir = $_POST['tempat_lahir'];
    $mahasiswa->tanggal_lahir = $_POST['tanggal_lahir'];
    $mahasiswa->jurusan = $_POST['jurusan'];
    $mahasiswa->program_studi = $_POST['program_studi'];
    $mahasiswa->ipk = $_POST['ipk'];
    if ($mahasiswa->update()) {
        echo "Data Mahasiswa berhasil diperbarui.";
    } else {
        echo "Data Mahasiswa gagal diperbarui.";
    }
}

// Delete
if (isset($_GET['delete'])) {
    $mahasiswa->nim = $_GET['nim'];
    if ($mahasiswa->delete()) {
        echo "Data Mahasiswa berhasil dihapus.";
    } else {
        echo "Data Mahasiswa gagal dihapus.";
    }
}

$mahasiswa_list = $mahasiswa->read();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
</head>
<body>

<h2>Form Mahasiswa</h2>
<form method="post">
    <input type="text" name="nim" placeholder="NIM" required><br>
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required><br>
    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" required><br>
    <input type="text" name="jurusan" placeholder="Jurusan" required><br>
    <input type="text" name="program_studi" placeholder="Program Studi" required><br>
    <input type="text" name="ipk" placeholder="IPK" required><br>
    <button type="submit" name="create">Tambah Mahasiswa</button>
    <button type="submit" name="update">Perbarui Mahasiswa</button>
</form>

<h2>Daftar Mahasiswa</h2>
<table border="1">
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Jurusan</th>
        <th>Program Studi</th>
        <th>IPK</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $mahasiswa_list->fetch(PDO::FETCH_ASSOC)): ?>
    <tr>
        <td><?php echo $row['nim']; ?></td>
        <td><?php echo $row['nama']; ?></td>
        <td><?php echo $row['tempat_lahir']; ?></td>
        <td><?php echo $row['tanggal_lahir']; ?></td>
        <td><?php echo $row['jurusan']; ?></td>
        <td><?php echo $row['program_studi']; ?></td>
        <td><?php echo $row['ipk']; ?></td>
        <td>
            <a href="?nim=<?php echo $row['nim']; ?>&delete=true">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
