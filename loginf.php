<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hospital System</title>
    <link rel="stylesheet">
    <style> 
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background: url('images/login.jpg') no-repeat center center fixed !important;
    background-size: cover !important; /* Ensure it covers the full screen */
     /* Fallback color */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Login & Signup Container */
.login-container {
    width: 350px;
    padding: 30px;
    background: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    text-align: center;
    animation: fadeIn 0.8s ease-in-out;
}

/* Fade-in animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Form Styling */
h2 {
    margin-bottom: 20px;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    text-align: left;
    margin-top: 10px;
    font-weight: bold;
}

input, select {
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    width: 100%;
}

/* Buttons */
button {
    margin-top: 15px;
    padding: 12px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s ease-in-out;
}

button:hover {
    background: #0056b3;
}

/* Error Messages */
.error-message {
    color: red;
    font-size: 14px;
    margin-bottom: 10px;
}

/* Responsive Design */
@media (max-width: 500px) {
    .login-container {
        width: 90%;
    }
}

    </style>
    <script>
        function loginUser(event) {
            event.preventDefault();

            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const role = document.getElementById("role").value;

            // Create a FormData object to send the data via POST
            const formData = new FormData();
            formData.append("email", email);
            formData.append("password", password);
            formData.append("role", role);

            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Redirect based on the role
                    if (data.role === 'Admin') {
                        window.location.href = 'admin_dashboard.php';
                    } else if (data.role === 'Doctor') {
                        window.location.href = 'doctor_dashboard.php';
                    } else if (data.role === 'Patient') {
                        window.location.href = 'patient_dashboard.php';
                    }
                } else {
                    // Display error message based on the response
                    document.getElementById("error-message").textContent = data.message;
                }
            })
            .catch(error => {
                console.error("Error:", error);
                document.getElementById("error-message").textContent = "An error occurred. Please try again.";
            });
        }
    </script>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    
    <!-- Error Message Display -->
    <p id="error-message" class="error-message"></p>

    <form id="loginForm" onsubmit="loginUser(event)">
        <label for="email">📧 Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">🔑 Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">👤 Role:</label>
        <select id="role" name="role" required>
            <option value="Admin">Admin</option>
            <option value="Doctor">Doctor</option>
            <option value="Patient">Patient</option>
        </select>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.html">Register here</a></p>
</div>

</body>
</html>
