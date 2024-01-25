const suggestionsList = ["zabawki", "inne", "dlugopisy", "kalendarze", "elektronika"];

function getSuggestions() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const filteredSuggestions = suggestionsList.filter(suggestion =>
        suggestion.toLowerCase().includes(searchTerm)
    );
    displaySuggestions(filteredSuggestions);
}

function displaySuggestions(suggestions) {
    const suggestionsListElement = document.getElementById('suggestionsList');
    suggestionsListElement.innerHTML = '';

    suggestions.forEach(suggestion => {
        const listItem = document.createElement('li');
        listItem.textContent = suggestion;
        listItem.addEventListener('click', function () {
            document.getElementById('searchInput').value = suggestion;
            handleSelectedSuggestion(suggestion);
            clearSuggestions();
        });
        suggestionsListElement.appendChild(listItem);
    });
}

function handleSelectedSuggestion(selectedSuggestion) {
    window.location.href = encodeURIComponent(selectedSuggestion);
}

function clearSuggestions() {
    document.getElementById('suggestionsList').innerHTML = '';
}