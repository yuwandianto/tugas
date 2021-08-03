<div class="container mt-2">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('index.php/admin/tambah_pesan'); ?>" method="post">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label for="mapel" class="col-sm-4">Mata Pelajaran</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Masukkan mata pelajaran" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="keterangan" class="col-sm-4">Isi Pesan</label>
                                <div class="col-sm-8">
                                    <textarea name="keterangan" required id="keterangan" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-hover mt-3">
        <thead>
            <th>No</th>
            <th>Mapel</th>
            <th>Keterangan</th>
            <th>Opsi</th>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($pesan as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p->mapel; ?></td>
                    <td><?= $p->keterangan; ?></td>
                    <td>
                        <a href="<?= base_url('index.php/admin/hapus_pesan/') . $p->id; ?>" class="badge badge-warning" onclick="return confirm('Yakin akan menghapus data ini?')"> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>