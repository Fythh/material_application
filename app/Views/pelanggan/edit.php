<h2>Edit Pelanggan</h2>

<form action="/pelanggan/update/<?= $pelanggan['id_pelanggan']; ?>" method="post">
    <label>Nama</label><br>
    <input type="text" name="nama_pelanggan" value="<?= $pelanggan['nama_pelanggan']; ?>"><br><br>

    <label>Telepon</label><br>
    <input type="text" name="telepon" value="<?= $pelanggan['telepon']; ?>"><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat"><?= $pelanggan['alamat']; ?></textarea><br><br>

    <button type="submit">Update</button>
</form>