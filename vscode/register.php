<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register</title>
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>

    <main>
        <section>
            <h2>Let's get you signed up!</h2>
            <p>Enter required information</p>
            <form action="/submit_registration" method="post">
                <label for="mobile">Mobile Number:</label>
                <input type="tel" id="mobile" name="mobile" required><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                
                <label for="type">Type:</label>
                <select id="type" name="type" required>
                    <option value="student">Student</option>
                    <option value="non_student">Non-Student</option>
                </select><br><br>
                
                <button type="next">NEXT</button>
            </form>
        </section>

        <section>
            <h2>Enter required information</h2>
            <form action="/complete_registration" method="post">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required><br><br>
                
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required><br><br>
                
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br><br>
                
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required><br><br>
                
                <label for="student_number">Student Number:</label>
                <input type="text" id="student_number" name="student_number" required><br><br>
                
                <button type="submit">COMPLETE REGISTRATION</button>
            </form>
        </section>
    </main>
</body>
</html>