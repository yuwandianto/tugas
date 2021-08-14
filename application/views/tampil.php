<div class="container col-lg-8 mt-2">
    <form action="<?= base_url('index.php/admin/tampil'); ?>" method="post">
        <div class="row mt-2 mb-3">
            <div class="col-md-4">
                <label for="kelas">Pilih Kelas</label>
                <select name="kelas" id="kelas" class="form-control js-example-basic-single" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($allkelas as $kls) : ?>
                        <option value="<?= $kls->nama_kelas; ?>"><?= $kls->nama_kelas; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5">
                <label for="tugas">Pilih Pesan</label>
                <select name="tugas" id="tugas" class="form-control" required>
                    <option value="">-- Pilih Pesan --</option>
                    <?php foreach ($alltugas as $tgs) : ?>
                        <option value="<?= $tgs->id; ?>"><?= $tgs->mapel . ' - ' . $tgs->keterangan; ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 pt-4">
                <button type="submit" class="btn btn-success">Tampilkan Data</button>
            </div>

        </div>
    </form>
    <div class="alert alert-info">
        <h5>
            Teks pesan mata pelajaran <?= $tugas->mapel; ?> yang akan diinput :
        </h5>
        <?= $tugas->keterangan; ?>
    </div>
    <form action="<?= base_url('index.php/admin/input'); ?>" method="post">
        <input type="hidden" name="tugas" value="<?= $tugas->id; ?>">
        <button type="submit" class="btn btn-success">Simpan</button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th width="90px"><label for="">Check</label> <input type="checkbox" id="master"> </th>
                    <th>Nama</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($siswa as $sis) : ?>
                    <tr>
                        <td style="text-align: right; padding-right: 15px"><input type="checkbox" name="check[]" id="ceker" value="<?= $sis->id; ?>"></td>
                        <td><?= strtoupper($sis->nama); ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>