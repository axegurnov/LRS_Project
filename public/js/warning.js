$(document).ready(function() {
	$(document).on("click", ".confirm", function() {
		if (!confirm("Вы уверены, что хотите продолжить удаление?")) {
			return false;
		}
	});
});