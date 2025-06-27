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
        // Daftar nama hari dan bulan dalam bahasa Indonesia
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

    <table border="1px" >
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; $no = 1; ?>
            <?php foreach ($pengeluaran as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= formatTanggalLengkap($row['tanggal']) ?></td>
                <td><?= esc($row['keterangan']) ?></td>
                <td>Rp <?= number_format($row['nominal'], 0, ',', '.') ?></td>
            </tr>
            <?php $total += $row['nominal']; ?>
            <?php endforeach; ?>
            <tr>
                <th colspan="2">Total</th>
                <th colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></th>
            </tr>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>