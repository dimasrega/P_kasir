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

            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newsubMenuModal">Buat akun baru</button>

            <table class="table table-hover" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Tanggal join</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($akun as $sm) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i; ?>
                            </th>
                            <td>
                                <?= $sm['name']; ?>
                            </td>
                            <td>
                                <?= $sm['email']; ?>
                            </td>

                            <td>
                                <?= $sm['no_telp']; ?>
                            </td>
                            <td>
                                <?= $sm['date_created']; ?>
                            </td>
                            <td>
                                <button class="badge badge-success" data-toggle="modal" data-target="#modaledit<?php echo $sm['id']; ?>">edit</button>
                                <a href="<?php echo base_url('admin/akunhapus/') . $sm['id']; ?>" class="badge badge-danger">delete</a>
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



<!-- Modal -->
<div class="modal fade" id="newsubMenuModal" tabindex="-1" aria-labelledby="newsubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newsubMenuModalLabel">Akun Kasir</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" method="post" action="<?= base_url('admin/akun') ?>">
                <div class="container">
                    <div class="form-group mt-5">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="no_telp" name="no_telp" placeholder="no telp" value="<?= set_value('no_telp'); ?>">
                        <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning btn-user btn-block">
                        Register Account
                    </button>

            </form>
        </div>
    </div>
</div>
</div>