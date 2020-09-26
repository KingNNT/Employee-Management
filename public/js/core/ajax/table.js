const ID_TABLE_EMPLOYEE = "#tableDataEmployee";
const ID_TABLE_JOB = "#tableDataJob";

const BASE_URL = "http://localhost:8080/Project/Employee-Management/";

function initEmployee() {
	let endpoint = BASE_URL + "api.php?category=employee&action=read";
	console.log(endpoint);

	let tableEmployee = $(ID_TABLE_EMPLOYEE).DataTable({
		processing: true,
		ajax: {
			url: endpoint,
			method: "GET",
			dataSrc: "",
		},
		columns: [
			{ data: "id" },
			{ data: "name" },
			{ data: "address" },
			{ data: "birthday" },
			{ data: "level" },
		],
	});

	let element = ID_TABLE_EMPLOYEE + " tbody";

	$(element).on("click", "tr", function () {
		let data = tableEmployee.row(this).data();
		let id = data["id"];
		reloadTableDataJob(id);
	});
}

/* JOB */

let tempAction = "read";
let endpointJob =
	BASE_URL + "api.php?category=job&action=" + tempAction + "&id=";

function initJob(id = 1) {
	let endpoint = endpointJob + id;
	console.log(endpoint);

	tableJob = jQuery(ID_TABLE_JOB).DataTable({
		processing: true,
		ajax: {
			url: endpoint,
			method: "POST",
			dataSrc: "",
		},
		columns: [
			{ data: "id" },
			{ data: "name" },
			{ data: "expected_completion_date" },
			{ data: "actual_completion_date" },
			{ data: "is_done" },
		],
	});
}

function reloadTableDataJob(id) {
	let endpoint = endpointJob + id;
	tableJob.ajax.url(endpoint).load();
}

/* Loaded */
$(document).ready(function () {
	initEmployee();
	initJob();
});
