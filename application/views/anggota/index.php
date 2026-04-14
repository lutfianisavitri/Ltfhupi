<div class="container-fluid">

<h2 class="h3 mb-4 text-gray-800">Data Anggota</h2>

<a href="<?= site_url('anggota/tambah'); ?>" class="btn btn-primary mb-3">
    Tambah Anggota
</a>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">

<table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>No</th>
        <th>Nomor Anggota</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Email</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>

<tbody>
<?php if(!empty($anggota)): ?>
    <?php $no=1; foreach($anggota as $a): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $a->nomor_anggota; ?></td>
        <td><?= $a->nama; ?></td>
        <td><?= $a->telepon; ?></td>
        <td><?= $a->email; ?></td>
        <td>
            <span class="badge badge-success">
                <?= $a->status ?? 'Aktif'; ?>
            </span>
        </td>
        <td>
            <a href="<?= site_url('anggota/edit/'.$a->id); ?>" 
               class="btn btn-warning btn-sm">Edit</a>

            <a href="<?= site_url('anggota/hapus/'.$a->id); ?>" 
               onclick="return confirm('Yakin ingin hapus data ini?')" 
               class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="7" class="text-center">Data belum tersedia</td>
    </tr>
<?php endif; ?>
</tbody>

</table>

        </div>
    </div>
</div>
</div>


<!-- WAJIB: jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- WAJIB: DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- OPTIONAL: Styling DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


<!-- INIT DATATABLE -->
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>