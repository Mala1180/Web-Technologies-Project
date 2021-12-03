$(document).ready(function () {
    $("#SubmitLogout").click((e) => {
        e.preventDefault();
        logout();
    });

    function logout() {
        reqHelper.post("logout", "", {}, function (data) {
            console.log(data);
            /*
             * TODO: Unset AuthToken from localStorage
             */
        });
    }
});
