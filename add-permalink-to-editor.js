// Function to add permalink to the post editor header toolbar
function addPermalink() {
    const postEditorHeader = document.querySelector('.edit-post-header__toolbar');

    if (postEditorHeader) {
        const permalink = window.addPermalinkData.permalink;
        const permalinkHTML = `<a href="${permalink}" target="_blank" class="components-button is-tertiary">View Post</a>`;
        postEditorHeader.insertAdjacentHTML('beforeend', permalinkHTML);
        return true;
    }
    return false;
}

// Wait for DOM to be fully loaded and subscribe to changes in the editor store
wp.domReady(function () {
    const unsubscribe = wp.data.subscribe(() => {
        if (addPermalink()) {
            unsubscribe();
        }
    });
});
