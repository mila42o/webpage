document.getElementById('inp').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('login').value;
    const password = document.getElementById('pas').value;
    fetch('http://localhost/webpage/api/return.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username, password: password })
    })
    .then(response => response.json())
    .then(data => {    
        console.log('PHP Response:', data);
        if (data) {
            alert('Login successful!');
            window.location.href = 'projects.html';
        } else {
            alert('Invalid login!!');
            window.location.href = 'index.html';
        }
    })
});