<h2>Data Users</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Username</th>
    <th>Role</th>
</tr>

<?php foreach($users as $u): ?>

<tr>
    <td><?= $u['id_users']; ?></td>
    <td><?= $u['nama_pengguna']; ?></td>
    <td><?= $u['username']; ?></td>
    <td><?= $u['role']; ?></td>
</tr>

<?php endforeach; ?>

</table>
