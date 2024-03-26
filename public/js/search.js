// search.js

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchResultsContainer = document.getElementById('search-results-container');

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.trim();

        // Check if the search term is not empty
        if (searchTerm.length > 0) {
            // Perform AJAX request to fetch auto-completion results
            const xhr = new XMLHttpRequest();
            const url = '/pages/search.php'; // Replace with the actual path to your search handler script
            const params = 'q=' + encodeURIComponent(searchTerm);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the content of searchResultsContainer with the received results
                    searchResultsContainer.innerHTML = xhr.responseText;
                }
            };

            xhr.open('GET', url + '?' + params, true);
            xhr.send();
        } else {
            // Clear the search results if the search term is empty
            searchResultsContainer.innerHTML = '';
        }
        // Add click event listener to handle selection from search results
        searchResultsContainer.addEventListener('click', function (event) {
            const selectedResult = event.target.textContent.trim();
            
            // Autocomplete the search bar with the selected result
            searchInput.value = selectedResult;
            
            // Clear the search results container
            searchResultsContainer.innerHTML = '';
        });
    });
});    
