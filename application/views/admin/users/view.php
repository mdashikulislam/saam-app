<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="card card-default">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-pencil"></i>
						&nbsp; View User </h3>
				</div>
			</div>
			<div class="card-body">

				<!-- For Messages -->
				<?php $this->load->view('admin/includes/_messages.php') ?>

				<div class="form-group">
					<label for="username" class="col-md-2 control-label"><?= trans('username') ?></label>

					<div class="col-md-12">
						<input disabled type="text" name="username" value="<?= $user['username']; ?>" class="form-control"
							   id="username" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="firstname" class="col-md-2 control-label"><?= trans('firstname') ?></label>

					<div class="col-md-12">
						<input disabled type="text" name="firstname" value="<?= $user['firstname']; ?>" class="form-control"
							   id="firstname" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label for="lastname" class="col-md-2 control-label"><?= trans('lastname') ?></label>

					<div class="col-md-12">
						<input disabled type="text" name="lastname" value="<?= $user['lastname']; ?>" class="form-control"
							   id="lastname" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="col-md-2 control-label"><?= trans('email') ?></label>

					<div class="col-md-12">
						<input disabled type="email" name="email" value="<?= $user['email']; ?>" class="form-control" id="email"
							   placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="col-md-2 control-label"><?= trans('select_user_role') ?>*</label>
					<div class="col-md-12">
						<select disabled name="role" class="form-control">
							<option value=""><?= trans('select_role') ?></option>
							<?php foreach ($admin_roles as $role): ?>
								<?php if ($role['admin_role_id'] == $user['admin_role_id']): ?>
									<option value="<?= $role['admin_role_id']; ?>"
											selected><?= $role['admin_role_title']; ?></option>
								<?php else: ?>
									<option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="mobile_no" class="col-md-2 control-label"><?= trans('mobile_no') ?></label>

					<div class="col-md-12">
						<input disabled type="number" name="mobile_no" value="<?= $user['mobile_no']; ?>" class="form-control"
							   id="mobile_no" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="col-md-2 control-label"><?= trans('status') ?></label>

					<div class="col-md-12">
						<select disabled name="status" class="form-control">
							<option value=""><?= trans('select_status') ?></option>
							<option value="1" <?= ($user['is_active'] == 1) ? 'selected' : '' ?> >Active</option>
							<option value="0" <?= ($user['is_active'] == 0) ? 'selected' : '' ?>>Deactive</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="venue_id" class="col-md-2 control-label">Select Venue</label>
					<div class="col-md-12">
						<select disabled name="venue_id" id="venue_id" class="form-control">
							<?= getVenueDropdown($user['venue_id']) ?>
						</select>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</section>
</div>
