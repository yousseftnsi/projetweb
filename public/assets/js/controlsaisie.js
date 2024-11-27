document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", (e) => {
        let isValid = true;

        // Get form inputs
        const name = document.getElementById("name").value.trim();
        const price = parseFloat(document.getElementById("price").value.trim());
        const category = document.getElementById("category").value.trim();
        const description = document.getElementById("description").value.trim();
        const image = document.getElementById("form_gallery-upload").files[0];

        // Validate each field
        if (name === "") {
            alert("Le titre du produit est requis.");
            isValid = false;
        }

        if (isNaN(price) || price < 10) {
            alert("Le prix doit être d'au moins 10.");
            isValid = false;
        }

        if (category === "") {
            alert("La catégorie est requise.");
            isValid = false;
        }

        if (description === "") {
            alert("La description est requise.");
            isValid = false;
        }

        if (!image) {
            alert("Veuillez télécharger une image de produit.");
            isValid = false;
        }

        // Prevent form submission if invalid
        if (!isValid) {
            e.preventDefault();
        }
    });
});
