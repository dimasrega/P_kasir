<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <div class="row">
        <div class="col-lg">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message') ?>

            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newsubMenuModal">add new
                submenu</button>

            <table class="table table-hover" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($submenu as $sm) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i; ?>
                            </th>
                            <td>
                                <?= $sm['title']; ?>
                            </td>
                            <td>
                                <?= $sm['menu']; ?>
                            </td>
                            <td>
                                <?= $sm['url']; ?>
                            </td>
                            <td>
                                <?= $sm['icon']; ?>
                            </td>
                            <td>
                                <?= $sm['is_active']; ?>
                            </td>
                            <td>
                                <button class="badge badge-success" data-toggle="modal" data-target="#modaledit<?php echo $sm['id']; ?>">edit</button>
                                <a href="<?php echo base_url('menu/menuhapus/') . $sm['id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newsubMenuModal" tabindex="-1" aria-labelledby="newsubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newsubMenuModalLabel">Add new sub menu</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="submenu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="select menu">
                                <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                        <?php endforeach; ?>
                        </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
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
foreach ($submenu as $sm) : $no++; ?>
    <div class="modal fade" id="modaledit<?php echo $sm['id']; ?>" tabindex="-1" aria-labelledby="modaleditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaleditLabel">modal edit</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/menu_edit/' . $sm['id']); ?>" method="post">
                    <div class="modal-body" <?php echo form_open_multipart('menu/menu_edit'); ?> <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
                        <!-- </div> -->
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control" value="<?= $s['menu_id']; ?>">
                                <option value=""></option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
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