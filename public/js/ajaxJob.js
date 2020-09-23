function initTableData(id) {
	baseUrl = "http://localhost:8080/Project/Employee-Management/api.php";
	endpoint = `${baseUrl}?category=job`;

	let ajax = jQuery.ajax({
		type: "POST",
		url: endpoint,
		data: {
			action: "read",
			id: id,
		},
		dataType: "json",
	});
	ajax.done(function (response) {
		let listJob = response.map((eachJob) => {
			return {
				id: eachJob.id,
				name: eachJob.name,
				expectedCompletionDate: eachJob.expected_completion_date,
				actualCompletionDate: eachJob.actual_completion_date,
				isDone: eachJob.is_done,
			};
		});
		let table = jQuery("#tableDataJob").DataTable({
			processing: true,
			data: listJob,
			columns: [
				{ data: "id" },
				{ data: "name" },
				{ data: "expectedCompletionDate" },
				{ data: "actualCompletionDate" },
				{ data: "isDone" },
			],
		});
	}).fail(function (jqXHR, textStatus, errorThrown) {
		console.log("Error" + textStatus + ": " + errorThrown);
	});
}

$(document).ready(function () {
	$.noConflict();
	let id = 1;
	initTableData(id);
});
