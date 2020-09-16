function validatePassword() {
	let validator = $("#formSubmit").validate({
		rules: {
			password: {
				minlength: 5,
				required: true,
			},
			passwordConfirm: {
				required: true,
				minlength: 5,
				equalTo: "#password",
			},
		},
		message: {
			password: "Enter Password",
			passwordConfirm: "Enter Confirm Password Same as Password",
		},
	});
}

$(document).ready(function () {
	$("#btnSignUp").click(validatePassword());
});
