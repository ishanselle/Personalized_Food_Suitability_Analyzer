document.getElementById("Generate").addEventListener("click", function(event) {
    event.preventDefault();

    var formData = new FormData(document.querySelector(".Health_Profile_Form"));

    fetch("process_health_profile.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
            return;
        }

        document.querySelector(".Generate_Repotr").innerHTML = `
            <h2>Food Suitability Analysis</h2>
            <p><strong>Food Item:</strong> ${data.food_name}</p>
            <p><strong>Suitability:</strong> ${data.suitability}</p>
            <p><strong>Reason:</strong> ${data.reason}</p>
            <p><strong>Recommended Alternative:</strong> ${data.alternative}</p>
        `;

        document.querySelector(".Generate_Repotr").style.display = "block";
    })
    .catch(error => console.error("Error:", error));
});
