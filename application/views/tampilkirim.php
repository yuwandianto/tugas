<div class="container mt-2">
    <a href="<?= base_url('index.php/admin/proseskirim'); ?>" class="btn btn-success" onclick="return confirm('Anda akan mengirim semua pesan ?')">Kirim Pesan</a>
    <a href="<?= base_url('index.php/admin/hapuspesandikirim'); ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus semua pesan ?')">Hapus Semua Pesan</a>
    <table class="table table-hover mt-3">
        <thead>
            <th>No</th>
            <th>Nama Peserta Didik</th>
            <th>Kelas</th>
            <th>Pesan</th>
            <th>Mapel</th>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($list as $list) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $list->nama; ?></td>
                    <td><?= $list->kelas; ?></td>
                    <td><?= $list->keterangan; ?></td>
                    <td>
                        <a href="<?= base_url('index.php/admin/hapus_pesan_dikirim/') . $list->id; ?>" class="badge badge-warning" onclick="return confirm('Yakin akan menghapus data ini?')"> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>