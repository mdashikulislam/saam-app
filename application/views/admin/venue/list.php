<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">

<style>
	button
	{
		margin-top: 10px;
		margin-left: 10px;
	}
	.btn-xs
	{
		padding: 1px 5px !important;
		font-size: 12px !important;
		line-height: 1.5 !important;
		border-radius: 3px !important;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; <?= trans('users_list') ?></h3>
				</div>
				<div class="d-inline-block float-right">
					<?php if($this->rbac->check_operation_permission('add')): ?>
						<a href="<?= base_url('admin/users/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?= trans('add_new_user') ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body table-responsive">
				<table id="na_datatable" class="table table-bordered table-striped" width="100%">
					<thead>
					<tr>
						<th>#<?= trans('id') ?></th>
						<th>Logo</th>
						<th>Name</th>
						<th>Address</th>
						<th>Contact</th>
						<th>Number</th>
						<th>QR Stuff</th>
						<th>QR Customer</th>
						<th width="100" class="text-right"><?= trans('action') ?></th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</section>
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
	//---------------------------------------------------
	var table = $('#na_datatable').DataTable( {
		"processing": true,
		"serverSide": false,
		"ajax": "<?=base_url('admin/venue/datatable_json')?>",
		"order": [[4,'desc']],
		"columnDefs": [
			{ "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
			{ "targets": 1, "name": "logo", 'searchable':false, 'orderable':false},
			{ "targets": 2, "name": "name", 'searchable':true, 'orderable':true},
			{ "targets": 3, "name": "address", 'searchable':true, 'orderable':true},
			{ "targets": 4, "name": "contact", 'searchable':true, 'orderable':true},
			{ "targets": 5, "name": "number", 'searchable':false, 'orderable':false},
			{ "targets": 6, "name": "qr_stuff", 'searchable':true, 'orderable':true},
			{ "targets": 7, "name": "qr_customer", 'searchable':true, 'orderable':true},
			{ "targets": 8, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
		]
	});
</script>



