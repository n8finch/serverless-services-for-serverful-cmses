function refreshFeed( newsElem ) {
    // Insert your GET endpoint here that you received from your serverless service.
    // fetch('https://youre-serverless-endpoint-here.com/endpoint/' + newsElem.dataset.postId)
    fetch('https://duuzcix5c2.execute-api.us-east-1.amazonaws.com/breaking-news/' + newsElem.dataset.postId)
    .then(response => response.json())
    .then(data => {
        const timestamp = new Date(data.updatedAt);
        newsElem.innerHTML = data.content + '<p style="color: grey;"><em>Last updated: ' + timestamp + '</em></p>';
        
        setTimeout( function() {
            refreshFeed(newsElem);
        }, 3000 );
    });
}
const breakingNewsContainers = document.getElementsByClassName('breaking-news-container');

for( const newsElem of breakingNewsContainers ) {
  refreshFeed(newsElem);
}