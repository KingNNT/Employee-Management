<?php
    require_once "./controllers/admin/adminController.php";
        
    
    AdminController::checkAuth();
    

    $idEmployee = "";
    $name = "";
    $address = "";
    $birthday = "";
    $level = "";
    
    $resultSearch = true;
    $resultEdit = $resultRemove = false;


    if (Input::hasGet("search")) {
        $data = AdminController::search();
        if ($data !== false) {
            $idEmployee = $data->id;
            $name = $data->name;
            $address = $data->address;
            $birthday = $data->birthday;
            $level = $data->level;
        } else {
            $resultSearch = false;
        }
    }
    
    if (Input::hasPost("edit")) {
        if (AdminController::edit()) {
            $resultEdit = true;
        }
    }
    
    if (Input::hasPost("remove")) {
        if (AdminController::remove()) {
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
					<label for="idEmployee" class = "mr-1">ID Employee</label>
					<input type="text" name="idEmployee" class="m-2 text-center" id="idSearch" value = "<?php echo $idEmployee?>" placeholder="Nhập ID nhân viên cần tìm">
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
								<input type="text" name="birthday" class="text-center" value="<?php echo$birthday?>">
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
					<button type="submit" name="remove" class="login login-submit" id="btnRemove">
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
			<button class="btn btn-info m-3" id="btnAddJob">Add Job</button>

			<table
				class="table table-striped table-bordered table-hover table-inverse"
				id="tableDataJob"
			>
				<thead>
					<tr id="list-header">
						<th>ID</th>
						<th>Employee</th>
						<th>Name</th>
						<th>Expected Completion Date (Y- M- d)</th>
						<th>Actual Completion Date (Y- M- d)</th>
						<th>Is Done</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>


	<!-- Modal Add Job -->
	<div class="modal fade" id="jobModalAdd" tabindex="-1" role="dialog" aria-labelledby="jobModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Job</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="input-group">
						<label for="employee">Employee</label>
						<input type="text" name="employee" class="text-center">
					</div>
					<div class="input-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="text-center">
					</div>
					<div class="input-group">
						<label for="expectedCompletionDate">Expected Completion Date (Y- M- d)</label>
						<input type="text" name="expectedCompletionDate" class="text-center">
					</div>
					<div class="input-group">
						<label for="actualCompletionDate">Actual Completion Date (Y- M- d)</label>
						<input type="text" name="actualCompletionDate" class="text-center">
					</div>
					<div class="input-group">
						<label for="isDone">isDone</label>
						<input type="text" name="isDone" class="text-center">
					</div>
					<div class="resultAjax">
						<h6 class="text-primary text-center"></h6>
					</div>
				</div>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnAdd">Add</button>
				</div>
			</div>
		</div>
	</div>




	<!-- Modal Changes -->
	<div class="modal fade" id="jobModalChanges" tabindex="-1" role="dialog" aria-labelledby="jobModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Công Việc</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="input-group">
						<label for="name">Employee</label>
						<input type="text" name="employee" class="text-center">
					</div>
					<div class="input-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="text-center">
					</div>
					<div class="input-group">
						<label for="expectedCompletionDate">Expected Completion Date (Y- M- d)</label>
						<input type="text" name="expectedCompletionDate" class="text-center">
					</div>
					<div class="input-group">
						<label for="actualCompletionDate">Actual Completion Date (Y- M- d)</label>
						<input type="text" name="actualCompletionDate" class="text-center">
					</div>
					<div class="input-group">
						<label for="isDone">isDone</label>
						<input type="text" name="isDone" class="text-center">
					</div>
					<div id="resultAjax">
						<h6 class="text-primary text-center"></h6>
					</div>
				</div>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnSaveJob">Save changes</button>
					<button type="button" class="btn btn-warning" id="btnRemoveJob">Remove</button>
				</div>
			</div>
		</div>
	</div>


</main>

 <!--    DataTable    -->
<!-- <link rel="stylesheet" type="text/css"	href="<?echo PUBLIC_URL . 'css/dataTable/jquery.dataTables.css' ?>"/>
<script type="text/javascript" charset="utf8" src="<?echo PUBLIC_URL . 'js/dataTable/jquery.dataTables.js' ?>"></script> -->


   <!--    DataTable CDN   -->
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>



<script type="text/javascript" charset="utf8" src="<?echo PUBLIC_URL . 'js/core/ajax/adminControl.js'?>"></script>

<?php
    require_once("./views/layouts/footer.php");
?>