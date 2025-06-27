<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pengeluaran</title>
</head>
<body>
    <?php
    function formatTanggalLengkap($tanggal) {
        $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        $bulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli',
                'Agustus','September','Oktober','November','Desember'];

        $tanggalObj = new DateTime($tanggal);
        $namaHari = $hari[$tanggalObj->format('w')];
        $tgl = $tanggalObj->format('j');
        $namaBulan = $bulan[(int)$tanggalObj->format('n')];
        $tahun = $tanggalObj->format('Y');

        return "$namaHari, $tgl $namaBulan $tahun";
    }
    ?>

<h4>Laporan Pengeluaran</h4>
<p>Dari: <?= formatTanggalLengkap($tgl_awal) ?> sampai <?= formatTanggalLengkap($tgl_akhir) ?></p>

<table border="1px" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 50%;">Keterangan</th>
            <th style="width: 25%;">Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $grouped = [];
        $total = 0;
        foreach ($pengeluaran as $item) {
            $grouped[$item['tanggal']][] = $item;
            $total += $item['nominal'];
        }

        $no = 1;
        foreach ($grouped as $tgl => $items):
        ?>
        <tr>
            <td colspan="3" style="font-weight: bold; background-color: #f2f2f2;">
                <?= formatTanggalLengkap($tgl) ?>
            </td>
        </tr>
        <?php foreach ($items as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($row['keterangan']) ?></td>
            <td>Rp <?= number_format($row['nominal'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endforeach; ?>
        <tr>
            <th colspan="2">Total</th>
            <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
        </tr>
    </tbody>
</table>
<script>
    window.print();
</script>
</body>
</html>