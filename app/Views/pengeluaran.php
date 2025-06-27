<?= $this->extend('template') ?>

<?= $this->section('csscustom') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="text-end mb-3">
        <button type="button" id="openModalBtn" class="btn btn-outline-primary">Tambah</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">Cetak</button>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="myTable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Tanggal</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan diisi oleh DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="mb-3">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Beli Makan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" placeholder="30000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Cetak Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/pengeluaran/cetak') ?>" method="post" target="_blank" >
            <div class="modal-body">
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBasic" class="form-label">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" id="emailBasic" class="form-control" />
                    </div>
                    <div class="col mb-0">
                        <label for="dobBasic" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" id="dobBasic" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('jscustom') ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            ajax: {
                url: '<?php echo base_url("pengeluaran/getdata"); ?>', // Ganti dengan URL yang sesuai
                dataSrc: ''
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'nominal',
                    render: function(data, type, row) {
                // Format angka menggunakan toLocaleString()
                return Number(data).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                    }
                },
                {
                    data: 'tanggal',
                    render: function(data, type, row) {
                        // Mengubah format tanggal
                        const date = new Date(data);
                        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        return date.toLocaleDateString('id-ID', options);
                    }
                },
                // {
                //     data: null,
                //     defaultContent: '<button class="btn btn-sm btn-danger">Delete</button>'
                // }
            ]
        });

        // Fungsi untuk membuka modal
        document.getElementById("openModalBtn").addEventListener("click", function() {
            var modal = new bootstrap.Modal(document.getElementById("modalAdd"));
            modal.show();
        });

        // Submit form menggunakan AJAX
        $('#addForm').submit(function(e) {
            e.preventDefault(); // Mencegah form submit standar

            $.ajax({
                url: '<?php echo base_url("pengeluaran/add"); ?>', // Ganti dengan URL controller Anda
                type: 'POST',
                data: $(this).serialize(), // Mengambil semua data dari form
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        $('#modalAdd').modal('hide'); // Sembunyikan modal
                        table.ajax.reload(); // Reload DataTables
                        $('#addForm')[0].reset(); // Reset form
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>
