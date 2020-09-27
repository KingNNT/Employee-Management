/* JOB */
const ID_TABLE_JOB = "#tableDataJob";

const BASE_URL = "http://localhost:8080/Project/Employee-Management/";
let tempAction = "search";
let endpointJob =
	BASE_URL + "api.php?category=job&action=" + tempAction + "&idEmployee=";

function initJob(id) {
	let endpoint = endpointJob + id;
	console.log("endpoint ajax of Job: " + endpoint);

	let tableJob = $(ID_TABLE_JOB).DataTable({
		processing: true,
		ajax: {
			url: endpoint,
			method: "GET",
			dataSrc: function (response) {
				let data = JSON.stringify(response);
				console.log("Data Job: " + data);
				return JSON.parse(data);
			},
		},
		columns: [
			{ data: "id" },
			{ data: "id_employee" },
			{ data: "name" },
			{ data: "expected_completion_date" },
			{ data: "actual_completion_date" },
			{ data: "is_done" },
		],
	});
}

$.urlParam = function (name) {
	var results = new RegExp("[?&]" + name + "=([^&#]*)").exec(
		window.location.href
	);
	if (results == null) {
		return null;
	} else {
		return results[1] || 0;
	}
};

/* Loaded */
$(document).ready(function () {
	let id = $.urlParam("id");
	initJob(id);
});
