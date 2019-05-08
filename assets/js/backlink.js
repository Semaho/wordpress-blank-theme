/**
 * Uses History API to go back if a <a> href has same value of previous visited page.
 * If not, follows href has expected.
 * 
 * Just add `backlink` class to <a>.
 */

jQuery('.backlink').on('click', function(event)
{
    var ref = document.referrer,
        url = event.currentTarget.getAttribute('href');

    // Remove any trailing slash before comparison.
    ref = ref.replace(/\/$/, "");
    url = url.replace(/\/$/, "");

    if (ref === url)
    {
        event.preventDefault();
        window.history.back();
    }
});