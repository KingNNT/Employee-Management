<?php
    require_once("./autoload/autoload.php");
    require_once("./layouts/page/header.php");
    
    $title = "";
    
    if (!Auth::isAdmin()) {
        Redirect::url("index.php");
    }
?>

<main>
	<div class="container p-4">
		<div class="search d-flex justify-content-center">
			<form method="POST">
				<div class="input-box">
					<label for="">Username</label>
					<input type="text" name="username" class="m-2" required autocomplete="none">
					<button type="submit" name="find" class="login login-submit" id="btnFind">
						<img src="<?php echo PUBLIC_URI . "images/loupe.png"?>" />
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
								<input type="text" name="name" required autocomplete="none">
							</div>
						</div>
						<div class="col-6">
							<div class="input-box">
								<label for="">Address</label>
								<input type="text" name="address" required autocomplete="none">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="input-box">
								<label for="">Birhday</label>
								<input type="text" name="birthday" id="datepicker" required autocomplete="none">
							</div>
						</div>
						<div class="col-6">
							<div class="input-box">
								<label for="">Position</label>
								<input type="text" name="position" required autocomplete="none">
							</div>
						</div>
					</div>
				</div>
				<div class="btn d-flex justify-content-center">
					<button type="submit" name="edit" class="login login-submit" id="btnEdit">
						<img src="<?php echo PUBLIC_URI . "images/check.png"?>" />
					</button>
					<button type="submit" name="remove" class="login login-submit" id="btnEdit">
						<img src="<?php echo PUBLIC_URI . "images/bin.png"?>" />
					</button>
				</div>

			</form>
		</div>

	</div>
</main>

<?php
    require_once("./layouts/page/footer.php");
?>