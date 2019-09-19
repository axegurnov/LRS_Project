/* $(document).ready(function() {
    let statements = $(".statementInfo");
    let statementBtn = $(".showStatementInJson");

    $(statementBtn).click(function (e) {
        let statementInfo = [];
        let btnId = e.target.getAttribute('btnStatementid');
        for(let i = 0; i < statements.length; i++) {
            if(statements[i].getAttribute('statementId') === btnId) {
                if(statements[i].getAttribute('id') === 'statementLogin') {
                    console.log(statements[i].getAttribute('id'));
                    statementInfo.push(statements[i].innerText);
                }
            }
        }

        console.log(statementInfo);
    });
}); */


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