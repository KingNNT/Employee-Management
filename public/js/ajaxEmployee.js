let idTableEmployee = "#tableDataEmployee";

function initTableDataEmployee(data) {
	let tableEmployee = $(idTableEmployee).DataTable({
		processing: true,
		data: data,
		columns: [
			{ data: "id" },
			{ data: "name" },
			{ data: "address" },
			{ data: "birthday" },
			{ data: "level" },
		],
	});
	let element = idTableEmployee + " tbody";

	$(element).on("click", "tr", function () {
		let data = tableEmployee.row(this).data();
		let id = data["id"];
		reloadTableDataJob(id);
		// initTableDataJob(id);
	});
}
function getDataEmployee() {
	let baseUrl = "http://localhost:8080/Project/Employee-Management/";
	let category = "employee";
	let endpointEmployee = baseUrl + "api.php?category=" + category;

	let ajaxEmployee = jQuery.ajax({
		type: "POST",
		url: endpointEmployee,
		data: {
			action: "read",
		},
		dataType: "json",
	});
	ajaxEmployee
		.done(function (response) {
			let listEmployees = response.map((eachEmployee) => {
				return {
					id: eachEmployee.id,
					name: eachEmployee.name,
					address: eachEmployee.address,
					birthday: eachEmployee.birthday,
					level: eachEmployee.level,
				};
			});

			initTableDataEmployee(listEmployees);
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			console.log("Error: " + textStatus + ": " + errorThrown);
		});
}

$(document).ready(function () {
	// $.noConflict();
	getDataEmployee();
});
