<div class="container">
    <div class="my-3 p-3 col-md-10">
        <h6 class="border-bottom border-gray pb-2 mb-0">Percakapan</h6>
        <?php foreach ($res as $r) : ?>
            <div class="media text-muted pt-3 <?= ($r->id->fromMe != 1) ? 'text-right' : ''; ?>">

                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-danger"><?= '0' . substr(preg_replace("/[^0-9]/", "", $r->from), 2,); ?></strong>
                    <?= str_replace(['"', '\r', '\n'], ['', '', '<br>'], (json_encode($r->body))); ?>
                </p>
            </div>
        <?php endforeach; ?>

        <form action="<?= base_url('index.php/admin/balas_pesan'); ?>" class="mt-2" method="post">
            <input type="hidden" name="no" value="<?= $this->uri->segment(3); ?>">
            <div class="row">
                <div class="col-sm-9">
                    <textarea name="text" rows="2" class="form-control"></textarea>
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-success btn-block"> Kirim</button>
                </div>
            </div>

        </form>

    </div>


</div>