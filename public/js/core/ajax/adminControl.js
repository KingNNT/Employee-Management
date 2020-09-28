/* JOB */
const ID_TABLE_JOB = "#tableDataJob";

const BASE_URL = "http://localhost:8080/Project/Employee-Management/";
let tempAction = "search";
let endpointJob =
	BASE_URL + "api.php?category=job&action=" + tempAction + "&idEmployee=";

function initJob(id) {
	let endpoint = endpointJob + id;
	console.log("endpoint ajax of Job: " + endpoint);

	let tableJob = $(ID_TABLE_JOB).DataTable({
		processing: true,
		ajax: {
			url: endpoint,
			method: "GET",
			dataSrc: function (response) {
				let data = JSON.stringify(response);
				console.log("Data Job: " + data);
				return JSON.parse(data);
			},
		},
		columns: [
			{ data: "id" },
			{ data: "id_employee" },
			{ data: "name" },
			{ data: "expected_completion_date" },
			{ data: "actual_completion_date" },
			{ data: "is_done" },
		],
	});

	let element = ID_TABLE_JOB + " tbody";

	$(element).on("click", "tr", function () {
		let data = tableJob.row(this).data();
		openModalChanges(data);
	});
}

function openModalChanges(data) {
	$("#jobModalChanges").modal();

	$('#jobModalChanges .modal-body input[name="employee"]').val(
		data.id_employee
	);
	$('#jobModalChanges .modal-body input[name="name"]').val(data.name);
	$('#jobModalChanges .modal-body input[name="expectedCompletionDate"]').val(
		data.expected_completion_date
	);
	$('#jobModalChanges .modal-body input[name="actualCompletionDate"]').val(
		data.actual_completion_date
	);
	$('#jobModalChanges .modal-body input[name="isDone"]').val(data.is_done);

	$("#btnSaveJob").click(() => {
		let endpointAjax =
			BASE_URL + "api.php?category=job&action=update&id=" + data.id;
		$.ajax({
			url: endpointAjax,
			method: "POST",
			data: {
				idEmployee: $(
					'#jobModalChanges .modal-body input[name="employee"]'
				).val(),
				name: $(
					'#jobModalChanges .modal-body input[name="name"]'
				).val(),
				expectedCompletionDate: $(
					'#jobModalChanges .modal-body input[name="expectedCompletionDate"]'
				).val(),
				actualCompletionDate: $(
					'#jobModalChanges .modal-body input[name="actualCompletionDate"]'
				).val(),
				isDone: $(
					'#jobModalChanges .modal-body input[name="isDone"]'
				).val(),
			},
		})
			.done(() => {
				$(".resultAjax h6").html("Successfully updated");
				setTimeout(() => {
					location.reload(true);
				}, 500);
			})
			.fail(() => {
				console.log("Failed to update");
			});
	});
	$("#btnRemoveJob").click(() => {
		let endpointAjax =
			BASE_URL + "api.php?category=job&action=delete&id=" + data.id;
		$.ajax({
			url: endpointAjax,
			method: "GET",
		})
			.done(() => {
				$("#resultAjax h6").html("Successfully deleted");
				setTimeout(() => {
					location.reload(true);
				}, 500);
			})
			.fail(() => {
				console.log("Failed to delete");
			});
	});
}

function openModalAdd() {
	$("#jobModalAdd").modal();

	$("#btnAdd").click(() => {
		let endpointAjax = BASE_URL + "api.php?category=job&action=create";
		$.ajax({
			url: endpointAjax,
			method: "POST",
			data: {
				idEmployee: $(
					'#jobModalAdd .modal-body input[name="employee"]'
				).val(),
				name: $('#jobModalAdd .modal-body input[name="name"]').val(),
				expectedCompletionDate: $(
					'#jobModalAdd .modal-body input[name="expectedCompletionDate"]'
				).val(),
				actualCompletionDate: $(
					'#jobModalAdd .modal-body input[name="actualCompletionDate"]'
				).val(),
				isDone: $(
					'#jobModalAdd .modal-body input[name="isDone"]'
				).val(),
			},
		})
			.done(() => {
				$(".resultAjax h6").html("Successfully added");
				setTimeout(() => {
					location.reload(true);
				}, 500);
			})
			.fail(() => {
				console.log("Failed to add");
			});
	});
}

$.urlParam = function (name) {
	var results = new RegExp("[?&]" + name + "=([^&#]*)").exec(
		window.location.href
	);
	if (results == null) {
		return null;
	} else {
		return results[1] || 0;
	}
};
function addEventAddJob() {
	$("#btnAddJob").click(() => {
		openModalAdd();
	});
}
/* Loaded */
$(document).ready(function () {
	let id = $.urlParam("idEmployee");
	initJob(id);
	addEventAddJob();
});
