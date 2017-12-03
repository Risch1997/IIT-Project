$(document).ready(function() {
	var emails = 1;

	$("#addEmail").click(function() {
		emails++;
		var newInput = "<tr> \
			<td><input type=\"email\" name=\"email" + emails + "\" placeholder=\"Send group code to valid email\"></td> \
		</tr>";
		$("#createGroupTable").append(newInput);
	});
});