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
				level: eachUser.level,
				name: eachUser.name,
				address: eachUser.address,
				birthday: eachUser.birthday,
			};
		});
		let table = jQuery("#tableData").DataTable({
			processing: true,
			data: modifiedUsers,
			columns: [
				{ data: "id" },
				{ data: "level" },
				{ data: "name" },
				{ data: "address" },
				{ data: "birthday" },
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
