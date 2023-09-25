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
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('kasir/keranjang'); ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <?php if (!isset($barang_dipilih)) : ?>
                                    <div class="form-group">
                                        <label>Scan Kode Menu</label>
                                        <input type="text" class="form-control col-sm-6 enter-prevent punya-kasir" placeholder="Scan Barang">
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">

                                    <label><?php if (!isset($barang_dipilih)) : ?>Atau Pilih <?php endif; ?>Menu</label>
                                    <div class="form-inline">
                                        <!-- <select id="barcode" class="form-control select2 col-sm-6" value=" <?= $s['nama_barang'] ?>"></select> -->
                                        <select name="id_barang" id="barcode" class="form-control select2 col-sm-6">
                                            <?php if (!isset($barang_dipilih)) : ?>
                                                <option selected hidden disabled>Pilih Barang</option>
                                            <?php endif; ?>
                                            <?php foreach ($barang_master as $row) : ?>
                                                <?php if (isset($barang_dipilih) && $barang_dipilih[0]['id'] == $row->id) : ?>
                                                    <option selected value="<?= $row->id ?>"><?= $row->nama_barang ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $row->id ?>"><?= $row->nama_barang ?></option>
                                                <?php endif; ?>
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
                                        Rp <span class="price-label"><?= $total_harga; ?></span>
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
                                    <td>
                                        Rp <span class="price-label"><?= $item['harga'] ?></span>
                                    </td>
                                    <td><?= $item['jumlah'] ?></td>
                                    <td>
                                        Rp <span class="price-label"><?= $item['harga'] * $item['jumlah'] ?></span></td>
                                    <td>
                                        <a href="<?= base_url('kasir/delete/' . $item['id']); ?>" class="badge badge-danger">Batalkan</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <form action="<?= base_url('kasir/checkout'); ?>" method="post">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Jumlah Pembayaran (Rp)</label>
                                <input name="bayar" type="number" class="form-control" placeholder="Jumlah Pembayaran">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Bayar</button>
                            </div>
                        </div>
                    </form>
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