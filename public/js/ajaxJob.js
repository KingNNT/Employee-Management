let idTableJob = "#tableDataJob";
let tableJob;

let baseUrl = "http://localhost:8080/Project/Employee-Management/";
let category = "job";
let action = "search";

let endpointJob =
	baseUrl + "api.php?category=" + category + "&action=" + action;

console.log(endpointJob);

function initTableDataJob(id = 1) {
	e = endpointJob + "&id=" + id;

	tableJob = jQuery(idTableJob).DataTable({
		processing: true,
		// data: data,
		ajax: {
			url: e,
			method: "POST",
			// data: {
			// 	action: action,
			// 	id: id,
			// },
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
	urlReload = endpointJob + "&action=" + action + "&id=" + id;
	tableJob.ajax.url(urlReload).load();
}

// function getDataJob(id) {
// 	let baseUrl = "http://localhost:8080/Project/Employee-Management/";
// 	let category = "job";
// 	let endpointJob = baseUrl + "api.php?category=" + category;

// 	let ajaxJob = jQuery.ajax({
// 		type: "POST",
// 		url: endpointJob,
// 		data: {
// 			action: action,
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
	// getDataJob(id);
	initTableDataJob();
});
