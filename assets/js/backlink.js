/**
 * Uses History API to go back if a <a> href has same value of previous visited page.
 * If not, follows href has expected.
 * 
 * Just add `backlink` class to <a>.
 */
// TODO: check if works well when using anchors on a page before going back.
document.querySelectorAll('.backlink').forEach(function(element) {
    element.addEventListener('click', function(event) {
        var ref = document.referrer,
            url = event.currentTarget.getAttribute('href');

        // Remove any trailing slash before comparison.
        ref = ref.replace(/\/$/, "");
        url = url.replace(/\/$/, "");

        if (ref === url) {
            event.preventDefault();
            window.history.back();
        }
    });
});