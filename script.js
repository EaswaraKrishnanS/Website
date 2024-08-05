document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const email = document.getElementById('email').value;
    
    console.log('Form submitted:', { username, password, email });
    
    fetch('/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password, email })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server response:', data);
        const messageElement = document.getElementById('message');
        if (data.success) {
            messageElement.style.color = 'green';
            messageElement.textContent = 'Registration successful!';
        } else {
            messageElement.textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
