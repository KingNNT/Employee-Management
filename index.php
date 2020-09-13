<?php
require_once "./autoload/autoload.php";

if (LOGIN_REQUIREMENT === true) {
    if (Auth::isLogin() === false) {
        Redirect::url("login.php");
    }
}

require_once "./layouts/page/header.php";
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
                            id="tableData"
                        >
                            <thead>
                                <tr id="list-header">
                                    <th id="ID">ID</th>
                                    <th id="Name">Name</th>
                                    <th id="Position">Position</th>
                                    <th id="Address">Address</th>
                                    <th id="Birthday">Birthday</th>
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
                            id="tableData"
                        >
                            <thead>
                                <tr id="list-header">
                                    <th id="ID">ID</th>
                                    <th id="Name">Name</th>
                                    <th id="Position">Position</th>
                                    <th id="Address">Address</th>
                                    <th id="Birthday">Birthday</th>
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

   <!--    DataTable CDN   -->
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<?php
require_once "./layouts/page/footer.php";
?>