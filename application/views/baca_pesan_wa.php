<div class="container d-flex justify-content-center">
    <div class="my-3 p-3 col-md-8">
        <h6 class="border-bottom border-gray pb-2 mb-0 text-center" style="font-size: 15pt;">Percakapan</h6>
        <?php foreach ($res as $r) : ?>
            <div class="media text-muted pt-3 <?= ($r->id->fromMe != 1) ? 'text-right' : ''; ?>">

                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-danger" style="margin: -12px 0px 10px 0px"><?= '0' . substr(preg_replace("/[^0-9]/", "", $r->from), 2,); ?>

                        <?php if ($r->ack == 1) {
                            echo '<span class="material-icons" style="font-size: 12pt; color:#e8301c">done</span>';
                        } elseif ($r->ack == 2) {
                            echo '<span class="material-icons" style="font-size: 12pt; color: #e8d71c">done_all</span>';
                        } elseif ($r->ack == 3) {
                            echo '<span class="material-icons" style="font-size: 12pt; color: #0560f2">done_all</span>';
                        }; ?>

                    </strong>


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