<!-- Page title -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <section class="content">
        <div class="container-fluid">
            <div class="card mb-3 p-4">
                <div class="row">
                    <div class="col-lg-12">
                        <label class="form-label">Keuntungan Bulan Ini</label>
                        <h1 class="display-4 text-success">Rp <span class="price-label"><?= $total; ?></span></h1>
                    </div>
                </div>
            </div>
            <div class="card mb-3 p-4">
                <form action="<?= base_url('kasir/filter') ?>" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Transaksi Bulan</label>
                            <input type="month" name="bulan" value="<?= $date; ?>" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <table class="table w-100 table-bordered table-hover" id="table_id">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Daftar Pembelian</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Kembali</th>
                                <th>Cetak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($laporan as $item) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $item['tanggal']; ?></td>
                                    <td>
                                        <ul>
                                            <?php $items = explode('|', $item['daftar_pembelian']); ?>
                                            <?php foreach ($items as $data) : ?>
                                                <?php if ($data != '') : ?>
                                                    <li><?= explode(':', $data)[0] . ' ' . explode(':', $data)[1]; ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td>
                                        Rp <span class="price-label"><?= $item['total']; ?></span>
                                    </td>
                                    <td>
                                        Rp <span class="price-label"><?= $item['bayar']; ?></span>
                                    </td>
                                    <td>
                                        Rp <span class="price-label"><?= $item['bayar'] - $item['total']; ?></span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('kasir/laporan_pdf/' . $item['id']); ?>" class="badge badge-danger">Cetak</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
</div>



<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $("#table_id").dataTable();
    });
</script>