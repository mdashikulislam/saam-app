<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="card card-default">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"> <i class="fa fa-plus"></i>
						View Incident </h3>
				</div>
			</div>
			<div class="card-body">

				<!-- For Messages -->
				<?php $this->load->view('admin/includes/_messages.php') ?>
				<div class="row">
					<div class="form-group col-lg-6">
						<label for="venue" class=" control-label">Venue</label>
						<select disabled name="venue" id="venue" class="form-control">
							<?= getVenueDropdown($incident['venue']) ?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="person" class=" control-label">Person</label>
						<select disabled name="person" id="person" class="form-control">
							<?= getPersonDropdown($incident['person']) ?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="gender" class=" control-label">Gender</label>
						<select disabled name="gender" id="gender" class="form-control">
							<?= getGenderDropdown($incident['gender']) ?>
						</select>
					</div>
					<div disabled class="form-group col-lg-6">
						<label for="comments" class=" control-label">Comments</label>
						<input disabled type="text" value="<?= $incident['comments'] ?>" name="comments" class="form-control" id="comments" placeholder="">
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</section>
</div>
