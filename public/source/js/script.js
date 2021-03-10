function imagePriview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var videoExtention = /(\.mp4)$/i;
        let previewSection = document.getElementById("previewSection");

        reader.onload = function (e) {
            if (videoExtention.exec(e.target.result)) {
                previewSection.innerHTML = `
                <video
                    src="${e.target.result}"
                    class="rounded"
                    id="videoPreview"
                    style="width: 100%; height: 300px; object-fit: cover; object-position: center;"
                    controls>
                </video>
                `;
            } else {
                previewSection.innerHTML = `
                <img
                    src="${e.target.result}"
                    class="rounded"
                    id="imagePreview"
                    style="width: 100%; height: 300px; object-fit: cover; object-position: center;"
                />`;
            }
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
