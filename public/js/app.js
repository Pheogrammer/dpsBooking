function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];

    if (file) {
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block"; // Show image preview
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
            preview.style.display = "none"; // Hide image preview
            input.value = "";
        }
    } else {
        preview.src = "#";
        preview.style.display = "none"; // Hide image preview
    }
}

function clearImagePreview(inputId, previewId) {
    const preview = document.getElementById(previewId);
    preview.src = "#";
    preview.style.display = "none"; // Hide image preview
    const fileInput = document.getElementById(inputId);
    fileInput.value = "";
}
