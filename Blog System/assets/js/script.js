const searchInput = document.getElementById('search-input');
const resultsContainer = document.getElementById('search-results');

if(searchInput){
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();

        if(query.length < 1){
            resultsContainer.innerHTML = '';
            return;
        }

        fetch(`search_ajax.php?q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            resultsContainer.innerHTML = '';
            if(data.length > 0){
                data.forEach(post => {
                    const div = document.createElement('div');
                    div.classList.add('search-result-item');
                    div.innerHTML = `<strong>${post.title}</strong> <small>(${post.category} | ${post.created_at.substring(0,4)})</small>`;

                    div.addEventListener('click', () => {
                        window.location.href = `post.php?id=${post.id}`;
                    });

                    resultsContainer.appendChild(div);
                });
            } else {
                resultsContainer.innerHTML = '<div class="search-result-item">No results found</div>';
            }
        });
    });

}

const commentForm = document.getElementById('comment-form');
const commentsSection = document.querySelector('.comments-section');

if(commentForm && commentsSection){
    commentForm.addEventListener('submit', function(e){
        e.preventDefault();

        const formData = new FormData(commentForm);

        fetch('../public/add_comment_ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
    // Remove "No comments yet." if it exists
                const noComments = commentsSection.querySelector('.no-comments');
                if(noComments) noComments.remove();

                // Create new comment div
                const div = document.createElement('div');
                div.classList.add('comment', 'comment-box');
                div.innerHTML = `<strong>${data.comment.author}:</strong>
                                <p>${data.comment.comment_text}</p>
                                <small>${data.comment.created_at}</small>`;

                // Prepend comment to the section
                commentsSection.prepend(div);

                // Clear form
                commentForm.reset();
            } else {
                alert(data.message);
            }

        });
    });
}
