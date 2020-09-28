<?php
    require_once "./controllers/admin/adminController.php";
        
    
    AdminController::checkAuth();
    
    $id = "";
    $name = "";
    $address = "";
    $birthday = "";
    $level = "";
    
    $resultSearch = true;
    $resultEdit = $resultRemove = false;


    if (Input::hasGet("search")) {
        $data = AdminController::search();
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
					<label for="id" class = "mr-1">ID</label>
					<input type="text" name="id" class="m-2 text-center" id="idSearch" value = "<?php echo $id?>" placeholder="Nhập ID cần tìm kiếm">
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
			<table
				class="table table-striped table-bordered table-hover table-inverse"
				id="tableDataJob"
			>
				<thead>
					<tr id="list-header">
						<th id="ID">ID</th>
						<th id="ID">Employee</th>
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
	<!-- Modal -->
	<div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="jobModalLongTitle">Công Việc</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="input-group">
						<label for="name">Employee</label>
						<input type="text" name="employee" class="text-center" id="employee" value="">
					</div>
					<div class="input-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="text-center" id="name" value="">
					</div>
					<div class="input-group">
						<label for="expectedCompletionDate">Expected Completion Date</label>
						<input type="text" name="expectedCompletionDate" class="text-center" id="expectedCompletionDate" value="">
					</div>
					<div class="input-group">
						<label for="actualCompletionDate">Actual Completion Date</label>
						<input type="text" name="actualCompletionDate" class="text-center" id="actualCompletionDate" value="">
					</div>
					<div class="input-group">
						<label for="isDone">isDone</label>
						<input type="text" name="isDone" class="text-center" id="isDone" value="">
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



<script type="text/javascript" charset="utf8" src="<?echo PUBLIC_URL . 'js/core/ajax/jobTable.js'?>"></script>

<?php
    require_once("./views/layouts/footer.php");
?>