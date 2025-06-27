<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4" >
                <div class="card" >
                    <div class="card-body" style="height: 190px;" >
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= base_url() ?>sneat/assets/img/icons/unicons/chart-success.png" alt="chart success"
                                    class="rounded">
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Dana Masuk Hari Ini</span>
                        <h3 class="card-title text-danger fw-bold text-nowrap mb-1">$12,628</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4"  >
                <div class="card">
                    <div class="card-body" style="height: 190px;" >
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= base_url() ?>sneat/assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                    class="rounded">
                            </div>
                        </div>
                        <span>Dana Keluar Hari ini</span>
                        <h3 class="card-title text-danger fw-bold text-nowrap mb-1">Rp <?= number_format($total_today['nominal']) ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4" >
                <div class="card" >
                    <div class="card-body" style="height: 190px;" >
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= base_url() ?>sneat/assets/img/icons/unicons/chart-success.png" alt="chart success"
                                    class="rounded">
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Dana Masuk Bulan Ini</span>
                        <h3 class="card-title text-success fw-bold text-nowrap mb-1">$12,628</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4"  >
                <div class="card">
                    <div class="card-body" style="height: 190px;" >
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= base_url() ?>sneat/assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                    class="rounded">
                            </div>
                        </div>
                        <span>Dana Keluar Bulan ini</span>
                        <h3 class="card-title text-danger fw-bold text-nowrap mb-1">Rp <?= number_format($total_month['nominal']) ?></h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">List Dana Keluar Hari ini</div>
                <ol>
                    <?php foreach($pengeluaran_harian as $hh): ?>
                    <li> <?= $hh['keterangan'].' - Rp '.number_format($hh['nominal']) ?> </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>