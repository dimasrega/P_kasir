<head>
    <title>Nota Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .header {
            text-align: center;
        }
    </style>

</head>

<body>
    <h1 class="header">
        <?= $user['name']; ?>
    </h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th class="header">Daftar Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penjualan as $item) : ?>
                <tr>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <td>
                    : Rp <span class="price-label"><?= $item['total']; ?></span>
                </td>
            </tr>
            <tr>
                <th colspan="3">Pembayaran</th>
                <td>
                    : Rp <span class="price-label"><?= $item['bayar']; ?></span>
                </td>
            </tr>
            <tr>
                <th colspan="3">Kembalian</th>
                <td>
                    : Rp <span class="price-label"><?= $item['bayar'] - $item['total']; ?></span>
                </td>
            </tr>
        </tfoot>
    </table>


</body>