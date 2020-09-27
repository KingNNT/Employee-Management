<?php
    require_once("./controllers/admin/adminController.php");
        
    
    adminController::checkAuth();
    
    $id = "";
    $name = "";
    $address = "";
    $birthday = "";
    $level = "";
    
    $resultSearch = true;
    $resultEdit = $resultRemove = false;


    if (Input::hasGet("search")) {
        $data = adminController::search();
        if ($data !== false) {
            $id = $data->id;
            $name = $data->name;
            $address = $data->address;
            $birthday = $data->birthday;
            $level = $data->level;
        } else {
            $resultSearch = false;
        }
    }
    
    if (Input::hasPost("edit")) {
        if (adminController::edit()) {
            $resultEdit = true;
        }
    }
    
    if (Input::hasPost("remove")) {
        if (adminController::remove()) {
            $resultRemove = true;
        }
    }

?>
<main>
	<div class="container p-4">
		<h3 class="text-center text-primary">Admin Dashboard</h3>
		<div class="search d-flex justify-content-center">
			<form method="GET">
				<div class="input-box">
					<label for="id" class = "mr-1">ID</label>
					<input type="text" name="id" class="m-2 text-center" value = "<?php echo $id?>" placeholder="Nhập ID cần tìm kiếm">
					<button type="submit" name="search" class="login login-submit" id="btnSearch">
						<img src="<?php echo PUBLIC_URL . "images/loupe.png"?>" />
					</button>
				</div>
			</form>
		</div>
		<hr/>
		<h3 class="text-center mb-4">Thông Tin Nhân Viên</h3>
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
				<hr/>
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
			<?php if ($resultSearch === false): ?>
				<h5>Error: 404 Not Fpund</h5>
			<?php endif ?>
			<?php if ($resultEdit !== false): ?>
				<h5>Update Successful</h5>
			<?php endif ?>
			<?php if ($resultRemove !== false): ?>
				<h5>Remove Successful</h5>
			<?php endif ?>
		</div>
		<hr/>
		<h3 class="text-center mt-3">Danh Sách Công Việc Nhân Viên <?php echo $name ?></h3>
		<div class="">
			<table
				class="table table-striped table-bordered table-hover table-inverse"
				id="tableDataJob"
			>
				<thead>
					<tr id="list-header">
						<th id="ID">ID</th>
						<th id="Name">Name</th>
						<th id="Position">Expected Completion Date</th>
						<th id="Address">Actual Completion Date</th>
						<th id="Birthday">Is Done</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</main>
 <!--    DataTable    -->
<!-- <link rel="stylesheet" type="text/css"	href="<?echo PUBLIC_URL . 'css/dataTable/jquery.dataTables.css' ?>"/>
<script type="text/javascript" charset="utf8" src="<?echo PUBLIC_URL . 'js/dataTable/jquery.dataTables.js' ?>"></script> -->


   <!--    DataTable CDN   -->
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>



<script type="text/javascript" charset="utf8" src="<?echo PUBLIC_URL . 'js/core/ajax/table.js'?>"></script>

<?php
    require_once("./views/layouts/footer.php");
?>