// JavaScript code
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('search-input');
    const suggestionsContainer = document.getElementById('search-suggestions-container');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.trim();
        if (searchTerm === '') {
            suggestionsContainer.innerHTML = ''; // Clear suggestions if input is empty
        } else {
            fetchSuggestions(searchTerm);
        }
    });

    function fetchSuggestions(searchTerm) {
        const url = `search.php?q=${searchTerm}`; // Adjust the URL to your server-side script
        fetch(url)
            .then(response => response.json())
            .then(data => {
                displaySuggestions(data.suggestions);
            })
            .catch(error => console.error('Error fetching suggestions:', error));
    }

    function displaySuggestions(suggestions) {
        if (suggestions.length === 0) {
            suggestionsContainer.innerHTML = '<p>No suggestions found.</p>';
        } else {
            suggestionsContainer.innerHTML = ''; // Clear previous suggestions
            const ul = document.createElement('ul');
            suggestions.forEach(suggestion => {
                const li = document.createElement('li');
                li.textContent = suggestion;
                ul.appendChild(li);
            });
            suggestionsContainer.appendChild(ul);
        }
    }
});
