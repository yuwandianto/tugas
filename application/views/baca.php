<div class="container mt-4">
    <?php if ($this->session->flashdata('pesan')) : ?>
        <div class="row mb-4">
            <div class="col-md-12 alert alert-info">
                <?= $this->session->flashdata('pesan'); ?>
            </div>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/admin/hapus_semua_pesan_wa'); ?>" method="POST" onSubmit="return confirm('Anda akan menghapus semua pesan ?')">
        <?php foreach ($res->response as $rs) : ?>
            <?php if (!$rs->isGroup) : ?>
                <input type="hidden" name="nomor[]" value="<?= '0' . substr($rs->id->user, 2,); ?>">
            <?php endif; ?>
        <?php endforeach; ?>
        <button class="btn btn-danger">Hapus Semua Pesan Whatsapp</button>
    </form>
    <table class="table table-hover mt-3">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>HP</th>
            <th>Pesan Baru</th>
            <th>Opsi</th>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($res->response as $list) : ?>
                <?php if (!$list->isGroup) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $list->name; ?></td>
                        <td><?= '0' . substr($list->id->user, 2,); ?></td>
                        <td>
                            <?php if ($list->unreadCount > 0) {
                                # code...
                                echo $list->unreadCount . ' pesan belum dibaca';
                            }; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('index.php/admin/hapus_pesan_wa/') . '0' . substr($list->id->user, 2,); ?>" class="badge badge-warning" onclick="return confirm('Yakin akan menghapus data ini?')"> Hapus</a>
                            <a href="<?= base_url('index.php/admin/baca_pesan_wa/') . '0' . substr($list->id->user, 2,); ?>" class="badge badge-success"> Baca</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>