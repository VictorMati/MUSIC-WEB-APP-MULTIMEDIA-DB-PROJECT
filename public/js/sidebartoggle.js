document.addEventListener("DOMContentLoaded", function() {
    // Get the sidebar toggle button and the sidebar itself
    var sidebarToggle = document.getElementById("sidebarToggle");
    var sidebar = document.querySelector(".sidebar-container");

    // Add click event listener to the sidebar toggle button
    sidebarToggle.addEventListener("click", function() {
        // Toggle the 'active' class on the sidebar to show/hide it
        sidebar.classList.toggle("active");
    });
});
