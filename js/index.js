window.onload = function() {

    document.querySelector("header nav ul li:nth-child(2)")
            .addEventListener("click", function() {
                document.querySelector("header section:last-of-type").classList.add("hidden");
                document.querySelector("header section:first-of-type").classList.toggle("hidden");
    });

    document.querySelector("header nav ul li:nth-child(3)")
            .addEventListener("click", function() {
                document.querySelector("header section:first-of-type").classList.add("hidden");
                document.querySelector("header section:last-of-type").classList.toggle("hidden");
    });
};

