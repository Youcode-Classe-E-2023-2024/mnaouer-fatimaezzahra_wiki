const searchInput = document.getElementById('search-bar');
const content = document.getElementById('content');

searchInput.addEventListener('input', function (ev) {
    // Get the text from the textarea
    const text = searchInput.value;

    // Create a FormData object and append the text
    const formData = new FormData();
    formData.append('search', '');
    formData.append('text', text);

    // Make a POST request using the Fetch API
    fetch('index.php?page=home', {
        method: 'POST',
        body: formData,
    })
        .then(data => {
            data.text().then(html => {
                if (html.length > 0) {
                    content.innerHTML = html;
                } else {
                    content.innerHTML = `
                    <div class="text-center" style="height: 55vh;">
                        <p>No result found!</p>
                    </div>`;
                }
            });
            // Handle the response as needed
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors
        });
});