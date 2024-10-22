$(document).ready(function() {
    // Fetch news articles on page load
    fetchNews();

    // Handle form submission
    $('#newsForm').submit(function(event) {
        event.preventDefault();
        const headline = $('#headline').val();
        const description = $('#description').val();

        // Send POST request to add news
        $.post('add_news.php', { headline, description }, function(response) {
            alert(response);
            $('#newsForm')[0].reset(); // Reset form
            fetchNews(); // Refresh news articles
        });
    });

    // Function to fetch news articles
    function fetchNews() {
        $.get('fetch_news.php', function(data) {
            $('#newsContainer').empty(); // Clear existing news
            data.forEach(news => {
                const newsItem = `
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">${news.headline}</h5>
                            <p class="card-text">${news.description}</p>
                            <p class="card-text"><small class="text-muted">${news.created_at}</small></p>
                        </div>
                    </div>
                `;
                $('#newsContainer').append(newsItem);
            });
        }, 'json');
    }
});
