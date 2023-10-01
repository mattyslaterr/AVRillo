## AVRillo

Build a Laravel application that allows a user to register, send an email confirmation, and activate the user's account once they click on the link in the email.

- DTOs: Create appropriate Data Transfer Objects (DTOs) for user registration data.
- Controllers: Create a registration controller that handles user registration and account activation.
- Services: Write a service that:
- - Manages the registration logic.
- - Generates a unique token for email confirmation.
- - Sends the email (for this, you can use Laravel's mail facade with the log driver so emails are written to the log).
- Jobs:
- - If sending the email fails, retry sending it up to 3 times with a 1-hour delay between each try.
- Database:
- - Use migrations to set up a users table, which should include fields like id, name, email, password, email_verified_at, activation_token, and any other necessary fields.
- Routes:
- - GET /register - Show registration form.
- - POST /register - Handle registration logic.
- - GET /activate/{token} - Handle account activation logic.
- Views:
- - Create a simple registration form.
- - Create a dashboard view which just displays "Your account is activated!" once the user's account is activated.
## Setup

This application uses Laravel 9 and VueJS, installed via sail using SQLite database.
- ./vendor/bin/sail up
- php artisan serve

- The verification emails are linked to a Gmail account I created to send via SMTP.

## Credits
- Laravel Sail
- Vite / Vue
- SweetAlert2 - pop up notifications
