function initTableData() {
	baseUrl = "http://localhost:8080/Project/Employee-Management/api.php";
	endpoint = `${baseUrl}?category=employee`;

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
				address: eachUser.address,
				birthday: eachUser.birthday,
				level: eachUser.level,
			};
		});
		let table = jQuery("#tableData").DataTable({
			processing: true,
			data: modifiedUsers,
			columns: [
				{ data: "id" },
				{ data: "name" },
				{ data: "address" },
				{ data: "birthday" },
				{ data: "level" },
			],
		});
	}).fail(function (jqXHR, textStatus, errorThrown) {
		console.log(textStatus + ": " + errorThrown);
	});
}

$(document).ready(function () {
	$.noConflict();
	initTableData();
});
