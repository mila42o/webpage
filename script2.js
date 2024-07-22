/*document.addEventListener('DOMContentLoaded', function() {
    fetchCountries();

    function fetchCountries() {
        const apiEndpoint = 'api/proxy.php';
        fetch(apiEndpoint)
        .then(response => response.json())
        .then(data => {
            if (data) {
                populateCountryDropdown(data);
            } else {
                console.error('No countries found in the API response');
            }
        })
        .catch(error => console.error('Error fetching countries:', error));
    }

    function populateCountryDropdown(countries) {
        const countryDropdown = document.getElementById('country');
        countries.forEach(country => {
            const option = document.createElement('option');
            option.textContent = country.name;
            countryDropdown.appendChild(option);
        });
    }
});

document.getElementById('inp2').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('usern').value;
    const email = document.getElementById('login').value;
    const password = document.getElementById('pas').value;
    const role = document.getElementById('rolq').value;
    const country = document.getElementById('country').value;
    fetch('http://localhost/webpage/api/post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, username: username, password: password, role: role, country: country })
    })
    .then(response => response.json())
    .then(data => {    
        console.log('PHP Response:', data);
        if (data) {
            alert('New profile successfully!');
            window.location.href = 'projects.html';
        } else {
            alert('Already exists!!');
            window.location.href = 'index2.html';
        }
    })
});
*/
document.addEventListener('DOMContentLoaded', function() {
    // Ensure the country dropdown exists before proceeding
    const countryDropdown = document.getElementById('country');
    if (countryDropdown) {
        fetchCountries();
    } else {
        console.error('Country dropdown element not found');
    }

    function fetchCountries() {
        const apiEndpoint = 'api/proxy.php';
        fetch(apiEndpoint)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data && Array.isArray(data)) {
                    populateCountryDropdown(data);
                } else {
                    console.error('Invalid countries data:', data);
                }
            })
            .catch(error => console.error('Error fetching countries:', error));
    }

    function populateCountryDropdown(countries) {
        countries.forEach(country => {
            const option = document.createElement('option');
            option.textContent = country.name;
            countryDropdown.appendChild(option);
        });
    }

    // Ensure the form exists before adding an event listener
    const form = document.getElementById('inp2');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            console.log('im innn!!');

            const username = document.getElementById('usern').value;
            const email = document.getElementById('login').value;
            const password = document.getElementById('pas').value;
            const role = document.getElementById('rolq').value;
            const country = document.getElementById('country').value;

            fetch('http://localhost/webpage/api/post.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email: email, username: username, password: password, role: role, country: country })
            })
            .then(response => response.json())
            .then(data => {
                console.log('PHP Response:', data);
                if (data.success) {
                    alert('New profile successfully created!');
                    window.location.href = 'projects.html';
                } else {
                    alert('Profile already exists!');
                    window.location.href = 'index2.html';
                }
            })
            .catch(error => console.error('Error submitting form:', error));
        });
    } else {
        console.error('Form element not found');
    }
});
