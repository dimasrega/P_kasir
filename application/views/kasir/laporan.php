<!-- Page title -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <section class="content">
        <div class="container-fluid">
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
                    <table class="table w-100 table-bordered table-hover" id="laporan_penjualan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Daftar Pembelian</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Kembali</th>
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
                                                    <li><?= $data; ?></li>
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