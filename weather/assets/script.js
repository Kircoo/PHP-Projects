//Prevent submit form automaticlly
$("form").submit(function (e) {


	var error = "";

	if ($("#email").val() == "") {

		error += "An email is required.<br>";

	}

	if ($("#subject").val() == "") {

		error += "The subject field is required.<br>";

	}

	if ($("#content").val() == "") {

		error += "The content field is required.";

	}

	$("#error").html(error);

	if (error != "") {

		$("#error").html('<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' + error + '</div>');

		return false;

	} else {

		return true;

	}

});