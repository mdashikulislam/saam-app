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
						<label for="venue" class=" control-label">Venue</label>
						<select name="venue" id="venue" class="form-control">
							<?= getVenueDropdown() ?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="person" class=" control-label">Person</label>
						<select name="person" id="person" class="form-control">
							<?= getPersonDropdown() ?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="gender" class=" control-label">Gender</label>
						<select name="gender" id="gender" class="form-control">
							<?= getGenderDropdown() ?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="comments" class=" control-label">Comments</label>
						<input type="text" name="comments" class="form-control" id="comments" placeholder="">
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
