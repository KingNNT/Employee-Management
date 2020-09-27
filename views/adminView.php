<?php
    require_once("./controllers/admin/adminController.php");
        
    
    adminController::checkAuth();
    
    $id = "";
    $name = "";
    $address = "";
    $birthday = "";
    $level = "";
    
    $resultEdit = $resultRemove = false;


    if (Input::hasGet("search")) {
        $data = adminController::search();
        if ($data !== false) {
            $id = $data->id;
            $name = $data->name;
            $address = $data->address;
            $birthday = $data->birthday;
            $level = $data->level;
        }
    }
    
    if (Input::hasPost("edit")) {
        adminController::edit();
    }
    
    if (Input::hasPost("remove")) {
        adminController::remove();
    }

    /* FIXME: Bug is large. Don't use all feature search, edit, remove */
?>
<main>
	<div class="container p-4">
		<div class="search d-flex justify-content-center">
			<form method="GET">
				<div class="input-box">
					<label for="">ID</label>
					<input type="text" name="id" class="m-2 text-center" value = "<?php echo $id?>">
					<button type="submit" name="search" class="login login-submit" id="btnSearch">
						<img src="<?php echo PUBLIC_URL . "images/loupe.png"?>" />
					</button>
				</div>
			</form>
		</div>
		<hr/>
		<div class="info">
			<form method="POST" id="formSubmit">
				<div class="container-fluid">
					<div class="row">
						<div class="col-6">
							<div class="input-box">
								<label for="" class="mr-2">Name</label>
								<input type="text" name="name" class="text-center" value="<?php echo$name?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-box">
								<label for="">Address</label>
								<input type="text" name="address" class="text-center" value="<?php echo$address?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="input-box">
								<label for="">Birhday</label>
								<input type="text" name="birthday" id="datepicker" class="text-center" value="<?php echo$birthday?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-box">
								<label for="">Position</label>
								<input type="text" name="level" class="text-center" value="<?php echo$level?>">
							</div>
						</div>
					</div>
				</div>
				<div class="btn d-flex justify-content-center">
					<button type="submit" name="edit" class="login login-submit" id="btnEdit">
						<img src="<?php echo PUBLIC_URL . "images/check.png"?>" />
					</button>
					<button type="submit" name="remove" class="login login-submit" id="btnEdit">
						<img src="<?php echo PUBLIC_URL . "images/bin.png"?>" />
					</button>
				</div>

			</form>
		</div>
		<div class="d-flex justify-content-center">
			<?php if ($resultEdit !== false): ?>
				<h5>Update Successful</h5>
			<?php endif ?>
			<?php if ($resultRemove !== false): ?>
				<h5>Remove Successful</h5>
			<?php endif ?>
		</div>
	</div>
</main>
<?php
    require_once("./views/layouts/footer.php");
?>