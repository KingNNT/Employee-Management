<?php
    require_once "./views/layouts/header.php";
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="bg-light p-4">
                    <h3>Danh Sách Nhân Viên</h3>
                    <div class="mt-4">
                        <table
                            class="table table-striped table-bordered table-hover table-inverse"
                            id="tableDataEmployee"
                        >
                            <thead>
                                <tr id="list-header">
                                    <th id="ID">ID</th>
                                    <th id="Name">Name</th>
                                    <th id="Address">Address</th>
                                    <th id="Birthday">Birthday</th>
                                    <th id="Position">Position</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="bg-light p-4">
                    <h3>Danh Sách Công Việc</h3>
                    <div class="mt-4">
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



<script type="text/javascript" charset="utf8" src="<?echo PUBLIC_URL . 'js/ajaxEmployee.js'?>"></script>
<script type="text/javascript" charset="utf8" src="<?echo PUBLIC_URL . 'js/ajaxJob.js'?>"></script>

<?php
    require_once "./views/layouts/footer.php";
?>