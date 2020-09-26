const ID_TABLE_EMPLOYEE = "#tableDataEmployee";
const ID_TABLE_JOB = "#tableDataJob";

const BASE_URL = "http://localhost:8080/Project/Employee-Management/";

function initEmployee() {
	let endpoint = BASE_URL + "api.php?category=employee&action=read";
	console.log("endpoint ajax of Employee: " + endpoint);

	let tableEmployee = $(ID_TABLE_EMPLOYEE).DataTable({
		processing: true,
		ajax: {
			url: endpoint,
			method: "GET",
			dataSrc: function (response) {
				let data = JSON.stringify(response);
				console.log(data);
				return JSON.parse(data);
			},
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

let tempAction = "search";
let endpointJob =
	BASE_URL + "api.php?category=job&action=" + tempAction + "&id=";

function initJob(id = 1) {
	let endpoint = endpointJob + id;
	console.log("endpoint ajax of Job: " + endpoint);

	tableJob = $(ID_TABLE_JOB).DataTable({
		processing: true,
		ajax: {
			url: endpoint,
			method: "GET",
			dataSrc: function (response) {
				let data = JSON.stringify(response);
				console.log(data);
				return JSON.parse(data);
			},
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
