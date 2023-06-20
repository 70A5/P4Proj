document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    fetch(event.target.action, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('api_key').value = data.api_key;
                localStorage.setItem('api_key', data.api_key);
                localStorage.setItem('username', formData.get('username'));
                alert(data.message);
                logoutButton();
            } else {
                document.getElementById('api_key').value = '';
                document.getElementById('username').value = '';
                document.getElementById('password').value = '';
                alert(data.message);
            }
        });
});

// Check if the user is already logged in on page load
window.addEventListener('load', function() {
    var apiKey = localStorage.getItem('api_key');
    var username = localStorage.getItem('username');
    if (apiKey && username) {
        document.getElementById('api_key').value = apiKey;
        logoutButton();
    }
});

function logoutButton() {
    // Change the button to Logout
    var logoutButton = document.createElement('input');
    logoutButton.type = 'button';
    logoutButton.value = 'Logout';
    logoutButton.className = 'btn btn-danger';
    logoutButton.addEventListener('click', function() {
        // Clear the local storage and reload the page
        localStorage.removeItem('api_key');
        localStorage.removeItem('username');
        location.reload();
    });

    var loginButton = document.getElementById('loginButton');
    loginButton.parentNode.replaceChild(logoutButton, loginButton);
}
