function initTableData() {
	baseUrl = "http://localhost:8080/Project/Employee-Management/api.php";
	endpointEmployee = `${baseUrl}?category=employee`;

	let ajax = jQuery.ajax({
		type: "POST",
		url: endpointEmployee,
		data: {
			action: "read",
		},
		dataType: "json",
	});
	ajax.done(function (response) {
		let listEmployees = response.map((eachEmployee) => {
			return {
				id: eachEmployee.id,
				name: eachEmployee.name,
				address: eachEmployee.address,
				birthday: eachEmployee.birthday,
				level: eachEmployee.level,
			};
		});
		let table = jQuery("#tableDataEmployee").DataTable({
			processing: true,
			data: listEmployees,
			columns: [
				{ data: "id" },
				{ data: "name" },
				{ data: "address" },
				{ data: "birthday" },
				{ data: "level" },
			],
		});
	}).fail(function (jqXHR, textStatus, errorThrown) {
		console.log("Error: " + textStatus + ": " + errorThrown);
	});
}

$(document).ready(function () {
	$.noConflict();
	initTableData();
});
