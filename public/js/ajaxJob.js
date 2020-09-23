function initTableDataJob(id) {
	let baseUrl = "http://localhost:8080/Project/Employee-Management/api.php";
	let endpoint = `${baseUrl}?category=job`;

	let ajaxJob = jQuery.ajax({
		type: "POST",
		url: endpoint,
		data: {
			action: "read",
			id: id,
		},
		dataType: "json",
	});
	ajaxJob
		.done(function (response) {
			let listJob = response.map((eachJob) => {
				return {
					id: eachJob.id,
					name: eachJob.name,
					expectedCompletionDate: eachJob.expected_completion_date,
					actualCompletionDate: eachJob.actual_completion_date,
					isDone: eachJob.is_done,
				};
			});
			let tableJob = jQuery("#tableDataJob").DataTable({
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
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			console.log("Error" + textStatus + ": " + errorThrown);
		});
}

$(document).ready(function () {
	// $.noConflict();
	let id = 1;
	initTableDataJob(id);
});
