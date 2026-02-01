document.addEventListener('DOMContentLoaded', () => {

    /*  SEARCH AJAX  */

    const searchInput = document.getElementById('search-input');
    const resultsContainer = document.getElementById('search-results');

    if (searchInput && resultsContainer) {
        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length < 1) {
                resultsContainer.innerHTML = '';
                return;
            }

            fetch(`search_ajax.php?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    resultsContainer.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(post => {
                            const div = document.createElement('div');
                            div.classList.add('search-result-item');
                            div.innerHTML = `
                                <strong>${post.title}</strong>
                                <small>(${post.category} | ${post.created_at.substring(0, 4)})</small>
                            `;
                            div.onclick = () => {
                                window.location.href = `post.php?id=${post.id}`;
                            };
                            resultsContainer.appendChild(div);
                        });
                    } else {
                        resultsContainer.innerHTML =
                            '<div class="search-result-item">No results found</div>';
                    }
                });
        });
    }

    /*  COMMENT AJAX  */

    const commentForm = document.getElementById('comment-form');
    const commentsSection = document.querySelector('.comments-section');

    if (!commentForm || !commentsSection) return;

    commentForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(commentForm);

        fetch('../public/add_comment_ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text()) // 🔥 IMPORTANT CHANGE
        .then(html => {

            const noComments = commentsSection.querySelector('.no-comments');
            if (noComments) noComments.remove();

            commentsSection.insertAdjacentHTML('afterbegin', html);
            commentForm.reset();
        })
        .catch(() => alert('Something went wrong'));
    });

});
