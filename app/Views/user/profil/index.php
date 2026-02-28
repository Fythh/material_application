<!DOCTYPE html>
<html>
<head>
    <title>Profil User</title>
</head>
<body>

<h2>Profil Saya</h2>

<a href="/user">Home</a> |
<a href="/user/produk">Produk</a> |
<a href="/user/pesanan">Pesanan Saya</a>

<hr>

<p><strong>Nama Pengguna:</strong> <?= $user['nama_pengguna']; ?></p>
<p><strong>Username:</strong> <?= $user['username']; ?></p>
<p><strong>Role:</strong> <?= $user['role']; ?></p>
<p><strong>Status:</strong> <?= $user['status_user']; ?></p>

<br>
<a href="/logout">Logout</a>

</body>
</html>