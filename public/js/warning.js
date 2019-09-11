$(document).ready(function() {
	$(document).on("click", ".del_confirm", function() {
		if (!confirm("Вы уверены, что хотите продолжить удаление?")) {
			return false;
		}
	});
	// $(document).on("click", ".edit_confirm", function() {
	// 	if (!confirm("Вы уверены, что хотите сохранить изменения?")) {
	// 		return false;
	// 	}
	// });
});