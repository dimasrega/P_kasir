<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>



    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message') ?>

            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">add new
                menu</button>

            <table class="table table-hover" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">menu</th>
                        <th scope="col">action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $s) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i; ?>
                            </th>
                            <td>
                                <?= $s['menu']; ?>
                            </td>
                            <td>
                                <button class="badge badge-success" data-toggle="modal" data-target="#modalmanagement<?php echo $s['id']; ?>">edit</button>
                                <a href="<?php echo base_url('menu/hapusmenumanagement/') . $s['id']; ?>" class="badge badge-danger">delete</a>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->



<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newMenuModalLabel">Add menu</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<?php $no = 0;
foreach ($menu as $s) : $no++; ?>
    <div class="modal fade" id="modalmanagement<?php echo $s['id']; ?>" tabindex="-1" aria-labelledby="modalmanagementLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalmanagementLabel">modal edit</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/management_edit/' . $s['id']); ?>" method="post">
                    <div class="modal-body" <?php echo form_open_multipart('menu/management_edit'); ?> <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" value="<?= $s['menu']; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <?php echo form_close() ?>
            </form>
        </div>
    </div>
    </div>
<?php endforeach; ?>



<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $("#table_id").dataTable();
    });
</script>