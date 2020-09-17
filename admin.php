<?php
    require_once("./autoload/autoload.php");
    require_once("./models/employeeModel.php");
    
    $title = "";
    require_once("./layouts/page/header.php");
    
    
    if (!Auth::isAdmin()) {
        Redirect::url("index.php");
    }
    
    $id = "";
    $name = "";
    $address = "";
    $birthday = "";
    $level = "";
    
    if (Input::hasPost("search")) {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $response = employeeModel::search($id);
            
            if ($response !== false) {
                $data = json_decode($response);
                if (is_object($data)) {
                    $name = $data->name;
                    $address = $data->address;
                    $birthday = $data->birthday;
                    $level = $data->level;
                }
            }
        }
    }

?>

<main>
	<div class="container p-4">
		<div class="search d-flex justify-content-center">
			<form method="POST">
				<div class="input-box">
					<label for="">ID</label>
					<input type="text" name="id" class="m-2 text-center" value = "<?php echo $id?>">
					<button type="submit" name="search" class="login login-submit" id="btnSearch">
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
								<input type="text" name="position" class="text-center" value="<?php echo$level?>">
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