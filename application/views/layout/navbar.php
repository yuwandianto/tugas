<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">WA-Notification</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= ($this->uri->segment(2) == '' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?= base_url('index.php/admin'); ?>">Home</a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(2) == 'pesan' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?= base_url('index.php/admin/pesan'); ?>">Pesan</a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(2) == 'kirim' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?= base_url('index.php/admin/kirim'); ?>">Kirim Pesan</a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(2) == 'baca_pesan' ? 'active' : ''); ?>">
                <a class="nav-link" href="<?= base_url('index.php/admin/baca_pesan'); ?>">Baca Pesan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#imporKelas">Import Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#imporSiswa">Import Siswa</a>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<?php if ($this->session->flashdata('error')) { ?>
    <div class="container mt-4">
        <div class="alert alert-warning" role="alert">
            <h5>Error Uploading File</h5>
            <?php foreach ($this->session->flashdata('error') as $error) {
                # code...
                echo $error;
            }; ?>
        </div>
    </div>
<?php }; ?>

<div class="modal fade" id="imporKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/importkelas'); ?>
            <input type="hidden" name="url" value="<?= $this->uri->segment(2); ?>">
            <div class="modal-body">
                <div class="form-group">
                    <a href="<?= base_url('index.php/admin/unduhformatkelas'); ?>" target="_blank" class="col-sm-4">Download Format Import</a>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-4">Pilih File</label>
                    <div class="col-sm-8">
                        <input type="file" name="data" id="data" accept=".xlsx">
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

<div class="modal fade" id="imporSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/importSiswa'); ?>
            <input type="hidden" name="url" value="<?= $this->uri->segment(2); ?>">
            <div class="modal-body">
                <div class="form-group">
                    <a href="<?= base_url('index.php/admin/unduhformatsiswa'); ?>" target="_blank" class="col-sm-4">Download Format Import</a>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-4">Pilih File</label>
                    <div class="col-sm-8">
                        <input type="file" name="data" id="data" accept=".xlsx">
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