let idTableEmployee = "#tableDataEmployee";

function initTableDataEmployee() {
	let baseUrl = "http://localhost:8080/Project/Employee-Management/api.php";
	let endpointEmployee = `${baseUrl}?category=employee`;

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
			let tableEmployee = $(idTableEmployee).DataTable({
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
			let element = idTableEmployee + " tbody";

			$(element).on("click", "tr", function () {
				let data = tableEmployee.row(this).data();
				alert("You clicked on " + data["id"] + " row");
				initTableDataJob(data["id"]);
			});
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			console.log("Error: " + textStatus + ": " + errorThrown);
		});
}

$(document).ready(function () {
	// $.noConflict();
	initTableDataEmployee();
});
