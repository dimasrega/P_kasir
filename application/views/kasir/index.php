<!-- Page title -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">


                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= $this->session->flashdata('message') ?>

                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newsubMenuModal"><i class="fa-solid fa-plus fa-beat-fade"></i>
                        Tambah Data</button>

                    <table class="table table-striped table-bordered" id="table_id">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Tanggal Input</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($barang_master as $s) : ?>
                                <tr>
                                    <th scope="row">
                                        <?= $i; ?>
                                    </th>
                                    <td>
                                        <?= $s['nama_barang'] ?>
                                    </td>
                                    <td>
                                        <?= $s['kategori'] ?>
                                    </td>
                                    <td>
                                        <?= $s['harga'] ?>
                                    </td>
                                    <td>
                                        <?= $s['stok'] ?>
                                    </td>
                                    <td>
                                        <?= $s['tgl_input'] ?>
                                    </td>
                                    <td>
                                        <button class="badge badge-success" data-toggle="modal" data-target="#modaledit<?php echo $s['id']; ?>">edit</button>
                                        <a href="<?php echo base_url('kasir/baranghapus/') . $s['id']; ?>" class="badge badge-danger">delete</a>
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
</div>
</div>



<!-- Modal -->
<div class="modal modal-blur fade" id="newsubMenuModal" tabindex="-1" aria-labelledby="newsubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newsubMenuModalLabel">Input Data Barang</h1>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Kasir/simpanbarang'); ?>" method="post" class="formbarang">
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama menu">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label class="form_label">Kategori</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="select kategori_menu">
                                <?php foreach ($kategori as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['kategori']; ?></option>
                        <?php endforeach; ?>
                        </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">stok</label>
                        <input type="text" class="form-control" name="stok" id="stok" placeholder="stok">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-circle-xmark fa-2lg"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-paper-plane "></i>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit -->
<?php $no = 0;
foreach ($barang_master as $s) : $no++; ?>
    <div class="modal modal-blur fade" id="modaledit<?= $s['id'] ?>" tabindex="-1" aria-labelledby="modaleditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaleditLabel">Input Data Barang</h1>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kasir/edit_barang/' . $s['id']); ?>" method="post" class="formbarang">
                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?= $s['nama_barang']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?= $s['harga']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="text" class="form-control" name="stok" id="stok" placeholder="stok" value="<?= $s['stok']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form_label">Kategori</label>
                            <select name="menu_id" id="menu_id" value="<?= $s['menu_id']; ?>" class="form-control">
                                <?php foreach ($kategori as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['kategori']; ?></option>
                                <?php endforeach; ?>
                                </option>
                            </select>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-circle-xmark fa-2lg"></i>Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-paper-plane"></i>update</button>
                        </div>
                    </form>
                </div>
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