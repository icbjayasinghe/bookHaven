<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sharing Library</title>
    <link rel="stylesheet" href="./css/Register.css">
</head>
<body>
    <header>
        <h1>Welcome to the Sharing Library</h1>
    </header>

    <main class="login-container">
        <div class="login-form">
            <h2>Register</h2>
            <form action="./functions/create_user.php" method="POST">
                <div class="input-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                
                <div class="input-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="login-button">Register</button>

                <div class="signup-link">
                    <p>Already have an account? <a href="./index.html">Login</a></p>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // 阻止表单默认提交

            let username = document.getElementById("username").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            // 这里可以添加注册逻辑，如向服务器发送请求
            alert("Registration Successful!");

            // 这里可以选择跳转到登录页面或者其他页面
            window.location.href = "login.html"; // 跳转到登录页面
        });
    </script>
</body>
<!-- <footer>
    <p>&copy; 2025 P2P Library. All rights reserved.</p>
</footer> -->
</html>

