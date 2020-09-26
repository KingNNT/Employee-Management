let idTableJob = "#tableDataJob";
let tableJob;
function initTableDataJob(id) {
	let baseUrl = "http://localhost:8080/Project/Employee-Management/";
	let category = "job";
	let endpointJob = baseUrl + "api.php?category=" + category;

	tableJob = jQuery(idTableJob).DataTable({
		processing: true,
		// data: data,
		ajax: {
			url: endpointJob,
			method: "POST",
			data: {
				action: "read",
				id: id,
			},
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
	alert("reloadTableData");
	tableJob.ajax.reload();
}

// function getDataJob(id) {
// 	let baseUrl = "http://localhost:8080/Project/Employee-Management/";
// 	let category = "job";
// 	let endpointJob = baseUrl + "api.php?category=" + category;

// 	let ajaxJob = jQuery.ajax({
// 		type: "POST",
// 		url: endpointJob,
// 		data: {
// 			action: "read",
// 			id: id,
// 		},
// 		dataType: "json",
// 	});
// 	let dataJob = [];
// 	ajaxJob
// 		.done(function (response) {
// 			let listJob = response.map((eachJob) => {
// 				return {
// 					id: eachJob.id,
// 					name: eachJob.name,
// 					expectedCompletionDate: eachJob.expected_completion_date,
// 					actualCompletionDate: eachJob.actual_completion_date,
// 					isDone: eachJob.is_done,
// 				};
// 			});

// 			// initTableDataJob(listJob);
// 		})
// 		.fail(function (jqXHR, textStatus, errorThrown) {
// 			console.log("Error" + textStatus + ": " + errorThrown);
// 		});
// }

$(document).ready(function () {
	// $.noConflict();
	let id = 1;
	// getDataJob(id);
	initTableDataJob(id);
});
