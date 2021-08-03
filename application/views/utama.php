    <div class="container mt-2">
        <form action="<?= base_url('index.php/admin/tampil'); ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <label for="kelas">Pilih Kelas</label>
                    <select name="kelas" id="kelas" class="form-control js-example-basic-single" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($kelas as $kls) : ?>
                            <option value="<?= $kls->nama_kelas; ?>"><?= $kls->nama_kelas; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tugas">Pilih Pesan</label>
                    <select name="tugas" id="tugas" class="form-control" required>
                        <option value="">-- Pilih Pesan --</option>
                        <?php foreach ($tugas as $tgs) : ?>
                            <option value="<?= $tgs->id; ?>"><?= $tgs->mapel . ' - ' . $tgs->keterangan; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 pt-4">
                    <button type="submit" class="btn btn-success">Tampilkan Data</button>
                </div>

            </div>
        </form>
    </div>