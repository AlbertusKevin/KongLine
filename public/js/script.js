$("#check-privacy-policy").on("click", function () {
    if (this.checked) {
        console.log("true");
        $("#sign-petition-button").attr("disabled", false);
    } else {
        console.log("false");
        $("#sign-petition-button").attr("disabled", true);
    }
});
