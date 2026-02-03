document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("brandForm");

    form.addEventListener("submit", function (e) {
        const brandName = document.getElementById("brand_name").value.trim();
        if (brandName === "") {
            e.preventDefault();
            alert("Brand name is required.");
        }
    });
});
