function initTableData(id) {
	baseUrl = "http://localhost:8080/Project/Employee-Management/api.php";
	endpoint = `${baseUrl}?category=job?id=${id}`;

	let ajax = jQuery.ajax({
		type: "POST",
		url: endpoint,
		data: {
			action: "read",
		},
		dataType: "json",
	});
	ajax.done(function (response) {
		let modifiedUsers = response.map((eachUser) => {
			return {
				id: eachUser.id,
				name: eachUser.name,
				expectedCompletionDate: eachUser.expectedCompletionDate,
				actualCompletionDate: eachUser.actualCompletionDate,
				isDone: eachUser.isDone,
			};
		});
		let table = jQuery("#tableDataEmployee").DataTable({
			processing: true,
			data: modifiedUsers,
			columns: [
				{ data: "id" },
				{ data: "name" },
				{ data: "expectedCompletionDate" },
				{ data: "actualCompletionDate" },
				{ data: "isDone" },
			],
		});
	}).fail(function (jqXHR, textStatus, errorThrown) {
		console.log(textStatus + ": " + errorThrown);
	});
}

$(document).ready(function () {
	$.noConflict();
	let id = 1;
	initTableData(id);
});
