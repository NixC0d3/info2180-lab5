document.addEventListener("DOMContentLoaded", function () {
    const lookupButton = document.getElementById("lookup");
    const lookupCitiesButton = document.getElementById("lookup-cities");
    const resultDiv = document.getElementById("result");

    const fetchData = (lookupType) => {
        const country = document.getElementById("country").value;
        const url = `world.php?country=${country}&lookup=${lookupType}`;
        fetch(url)
            .then((response) => response.text())
            .then((data) => {
                resultDiv.innerHTML = data;
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    lookupButton.addEventListener("click", () => fetchData(""));
    lookupCitiesButton.addEventListener("click", () => fetchData("cities"));
});
