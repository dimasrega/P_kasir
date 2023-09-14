<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1 class="m-0 text-dark">Transaksi</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form action="<?= base_url('kasir/keranjang'); ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label>Menu</label>
                                    <div class="form-inline">
                                        <!-- <select id="barcode" class="form-control select2 col-sm-6" value=" <?= $s['nama_barang'] ?>"></select> -->
                                        <select name="id_barang" id="barcode" class="form-control select2 col-sm-6">
                                            <option selected hidden disabled>Pilih Barang</option>
                                            <?php foreach ($barang_master as $row) : ?>
                                                <option value="<?= $row->id ?>"><?= $row->nama_barang ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="ml-3 text-muted" id="nama_produk"></span>
                                    </div>
                                    <small class="form-text text-muted" id="sisa"></small>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control col-sm-6" placeholder="Jumlah" id="jumlah">
                                </div>

                            </div>
                            <div class="col-sm-6 d-flex justify-content-end text-right nota">
                                <div>
                                    <div class="mb-0">
                                        <b class="mr-2">Total Harga</b> <span id="nota"></span>
                                    </div>
                                    <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">
                                        <?php $total_harga = 0; ?>
                                        <?php foreach ($barang as $item) {
                                            $total_harga += $item['harga'] * $item['jumlah'];
                                        }; ?>
                                        <?= $total_harga; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="bayar" class="btn btn-success">Masukkan Keranjang</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table w-100 table-bordered table-hover" id="transaksi">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Jlm Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barang as $item) : ?>
                                <tr>
                                    <td><?= $item['nama'] ?></td>
                                    <td><?= $item['harga'] ?></td>
                                    <td><?= $item['jumlah'] ?></td>
                                    <td><?= $item['harga'] * $item['jumlah'] ?></td>
                                    <td>
                                        <a href="<?= base_url('kasir/delete/' . $item['id']); ?>" class="badge badge-danger">delete</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>
</div>

<script>
    $.ajax({
        type: "POST",
        url: "",
        data: "data",
        dataType: "dataType",
        success: function(response) {

        }
    });
</script>
<!-- /.content-wrapper -->