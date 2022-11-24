<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="card card-default">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"> <i class="fa fa-plus"></i>
						View Venue </h3>
				</div>
			</div>
			<div class="card-body">
				<!-- For Messages -->
				<?php $this->load->view('admin/includes/_messages.php') ?>
				<div class="row">
					<div class="form-group col-lg-6">
						<label for="name" class=" control-label">Name</label>
						<input disabled type="text" value="<?= $venue['name']; ?>" name="name" class="form-control" id="name" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="address" class=" control-label">Address</label>
						<input disabled type="text" value="<?= $venue['address']; ?>" name="address" class="form-control" id="address" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="contact" class=" control-label">Contact</label>
						<input disabled type="text" value="<?= $venue['contact']; ?>" name="contact" class="form-control" id="contact" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="number" class=" control-label">Number</label>
						<input disabled type="number" value="<?= $venue['number']; ?>" step="any" name="number" class="form-control" id="number" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="qr_stuff" class=" control-label">QR Stuff</label>
						<input disabled type="text" value="<?= $venue['qr_stuff']; ?>" name="qr_stuff" class="form-control" id="qr_stuff" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<label for="qr_customer" class=" control-label">QR Customer</label>
						<input disabled type="text" value="<?= $venue['qr_customer']; ?>" name="qr_customer" class="form-control" id="qr_customer" placeholder="">
					</div>
					<div class="form-group col-lg-6">
						<?php if(!empty($venue['logo'])): ?>
							<p style="text-align: center"><img src="<?= base_url($venue['logo']); ?>" style="max-width: 150px"></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</section>
</div>
