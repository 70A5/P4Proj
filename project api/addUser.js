document.getElementById('addUserForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    fetch(event.target.action, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            document.getElementById('addUserForm').reset();
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
