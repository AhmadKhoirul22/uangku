<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pengeluaran</title>
</head>
<body>
    <h4>Laporan Pengeluaran</h4>
    <p>Dari: <?= $tgl_awal ?> sampai <?= $tgl_akhir ?></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Nominal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; $no = 1; ?>
            <?php foreach ($pengeluaran as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($row['keterangan']) ?></td>
                <td><?= number_format($row['nominal'], 0, ',', '.') ?></td>
                <td><?= $row['tanggal'] ?></td>
            </tr>
            <?php $total += $row['nominal']; ?>
            <?php endforeach; ?>
            <tr>
                <th colspan="2">Total</th>
                <th colspan="2"><?= number_format($total, 0, ',', '.') ?></th>
            </tr>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>