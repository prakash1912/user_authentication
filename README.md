﻿# User Authentication Form
This project is a simple User Authentication system built with core PHP, demonstrating essential features like registration, login, logout, session management, CSRF protection, and a "Remember Me" feature using cookies. This guide will help you set up, run, and understand the functionalities of this project.

Features:

User Registration: Users can register with a unique username and email, along with a strong password requirement.

Login with Session and Cookies: Users can log in using their credentials, with a session-based system and an optional "Remember Me" feature.

CSRF Protection: Prevents cross-site request forgery attacks by implementing CSRF tokens.

Password Hashing: Passwords are securely hashed before being stored in the database.

Error Handling: User-friendly error messages for incorrect input, login issues, and password requirements.

Prerequisites
PHP: Version 7.4 or higher
MySQL: Version 5.7 or higher
Apache or Nginx Web Server
Composer (optional, for dependency management)

File Structure
index.php: The main entry point, checks for the session or "Remember Me" cookie.

register.php: Processes the registration form, validates inputs, and stores user data.

login.php: Handles login requests, verifies credentials, and sets sessions or cookies.

logout.php: Destroys sessions and cookies, logging the user out.

config.php: Defines the BASE_URL constant for linking assets and resources.

db_connection.php: Contains the database connection setup.

assets/: Contains CSS files for styling.

Usages

User Registration:
Access register.php to create a new account.

Password must be strong: at least 8 characters, one uppercase, one lowercase, one number, and one special character.

User Login:
Go to login.php and enter your registered username or email, along with your password.

Select the "Remember Me" option to stay logged in after closing the browser.

User Dashboard:
Upon successful login, you'll be redirected to dashboard.php, where your username is displayed.

Logout:
Click "Logout" to end the session, which also clears the "Remember Me" cookie if it was set.

Security Considerations
Password Hashing: Passwords are hashed using PHP’s password_hash() for secure storage.

CSRF Tokens: Each form includes a CSRF token to prevent CSRF attacks.
Session and Cookie Management: Sessions and cookies are managed carefully to ensure safe and persistent logins.

Contributing
Feel free to fork this project, submit issues, and contribute through pull requests. Your feedback and contributions are welcome!
