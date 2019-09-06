$(document).ready(function() {
	$(document).on("click", ".classWarning", function() {
		if (!confirm("Вы уверены, что хотите продолжить удаление?")) {
			return false;
		}
	});
});