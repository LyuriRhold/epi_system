document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function() {
        updateLastActivity();
    });

    document.body.addEventListener('keydown', function() {
        updateLastActivity();
    });

    function updateLastActivity() {
        // Send AJAX request to update last activity
        fetch('/update-last-activity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({}),
        })
        .then(response => response.json())
        .then(data => {

        })
        .catch(error => {
            console.error('Error updating last activity:', error);
        });
    }
});
