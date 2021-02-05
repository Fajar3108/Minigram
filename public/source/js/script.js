function imagePriview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#imagePreview").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#imageInput").change(function () {
    imagePriview(this);
});

$(document).ready(function () {
    $(".tags-multiple").select2();
});
