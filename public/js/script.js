$(document).ready(function() {
    $(document).on("click", ".del_confirm", function() {
        if (!confirm("Вы уверены, что хотите продолжить удаление?")) {
            return false;
        }
    });
});