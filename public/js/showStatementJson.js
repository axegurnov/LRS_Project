$(document).ready(function() {
    let statements = $(".statementInJson");
    let statementBtn = $(".showStatementInJson");

    $(statementBtn).click(function (e) {
        let btnId = e.target.getAttribute('btnStatementid');
        let div = statements.attr('divStatementId', btnId);
        if(statements[btnId-1].getAttribute('divStatementId', btnId)) {
            if(div[btnId-1].getAttribute('hidden') === 'hidden') {
                div[btnId-1].removeAttribute("hidden");
            }
            else {
                div[btnId-1].setAttribute("hidden", "hidden");
            }
        }
    });
});