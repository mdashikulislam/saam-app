<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="card card-default">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"> <i class="fa fa-plus"></i>
						Add new Incident </h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/incident'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Incident List</a>
				</div>
			</div>
			<div class="card-body">

				<!-- For Messages -->
				<?php $this->load->view('admin/includes/_messages.php') ?>
				<?php echo form_open_multipart(base_url('admin/incident/add'), 'class="form-horizontal"');  ?>
				<div class="row">
					<div class="form-group col-lg-6">
						<label for="name" class=" control-label">Name</label>
						<input type="text" name="name" class="form-control" id="name" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="address" class=" control-label">Address</label>
						<input type="text" name="address" class="form-control" id="address" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="contact" class=" control-label">Contact</label>
						<input type="text" name="contact" class="form-control" id="contact" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="number" class=" control-label">Number</label>
						<input type="number" step="any" name="number" class="form-control" id="number" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="qr_stuff" class=" control-label">QR Stuff</label>
						<input type="text" name="qr_stuff" class="form-control" id="qr_stuff" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="qr_customer" class=" control-label">QR Customer</label>
						<input type="text" name="qr_customer" class="form-control" id="qr_customer" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="logo" class=" control-label">Logo</label>
						<input type="file" name="logo" class="form-control" id="logo" placeholder="" accept=".png, .jpg, .jpeg, .gif, .svg">
						<p><small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg</small></p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type="submit" name="submit" value="Add Incident" class="btn btn-primary pull-right">
					</div>
				</div>
				<?php echo form_close( ); ?>
			</div>
			<!-- /.box-body -->
		</div>
	</section>
</div>
