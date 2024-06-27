# INFT 2100 - Lab 1

In this lab, you will perform several tasks related to website development and database setup on the OpenTech server.

## Contents

1. [Abstract](#abstract)
2. [Initial Database Setup](#initial-database-setup)
3. [State Maintenance](#state-maintenance)
4. [Site Constants (constants.php)](#site-constants-constantsphp)
5. [Database Functions (db.php)](#database-functions-dbphp)
6. [Non-database functions (functions.php)](#non-database-functions-functionsphp)
7. [Dynamic Navigation](#dynamic-navigation)
8. [Secure Login Functionality (sign-in.php)](#secure-login-functionality-sign-inphp)
9. [Logout Functionality (logout.php)](#logout-functionality-logoutphp)
10. [Activity Logging](#activity-logging)

## Abstract

Your task is to implement responsive Bootstrap layouts for your website using a provided template. Your site will consist of three pages:

- The home page, available at `/index.php`.
- The user's main page, named `dashboard.php`, which is accessible only to signed-in users.
- The sign-in page, available at `/sign-in.php`, which is accessible only to users who have not yet signed in.

You are required to break the provided template into `header.php` and `footer.php`.

- `header.php` should include PHP comments with your name, date, and course code, as well as dynamic HTML comments. It should start a session, start an output buffer, and require the files `constants.php`, `db.php`, and `functions.php`.
- The footer should contain the bottom of your web page. The files `index.php`, `sign-in.php`, and `dashboard.php` should all implement your `header.php` and `footer.php` files.

If a signed-in user navigates to `/sign-in.php`, your site should redirect them to `/dashboard.php`. Similarly, if a non-signed-in user navigates to `/dashboard.php`, your site should redirect them to `/sign-in.php`.

There will be a "Sign out" button on `dashboard.php` and in the dynamic nav bar that will destroy the session and direct the user to `/sign-in.php`, where an appropriate message will be displayed.

On the server side, every page will include the same `header.php` and `footer.php`, while implementing custom logic specific to that page. In your header, you will need to include the Bootstrap CSS library, as well as logic to include CSS specific to the script you are running.

## Initial Database Setup

Your site will require a database to store user information. For this course, you will be using PostgreSQL. Create a script called `db.php`. This script should contain a function named `db_connect()` that returns a connection to your database using the PHP function `pg_connect()` and creates your prepared statements using the PHP function `pg_prepare()`. Include this `db.php` script in `header.php`. There will be no other way to access the database except through this script and the prepared statements it creates.

You will implement the following prepared statements:

- `user_select`: Takes one parameter, an id, and retrieves that user.
- `user_update_login_time`: Takes two arguments, id and the current time, and updates the appropriate user's record so the last login timestamp is set to the current timestamp.

Create an SQL file called `users.sql`, including comments with your name, date, and course code. This file will be run manually on the OpenTech server command line using syntax like:

```bash
psql -d DATABASE_NAME -f users.sql
```

You will run this command before you submit lab, to ensure there is data to test with. The script should be available on OpenTech in a `sql` sub-directory within your working folder (e.g., `/var/www/html/webd3201/userid`). Please note that in a real-world scenario, exposing database information like this is not recommended, but for this assignment, it's required for assessment purposes.

### Database Initialization

The `users.sql` script will create a table called "users" with appropriate data types to store the following information:

- Id (primary key)
- Email (unique in the database)
- First name
- Last name
- Password Hash (see security lecture)
- Created time (a timestamp)
- Last time the user logged in (a timestamp)
- Phone extension
- User type (a field that can store up to 2 characters, which later I changed to 5)

For this assignment, all users will be designated as "admins," and you should store this as a single character (refer to notes in `constants.php`). Do not use "email" as the primary key; create an appropriate field for it.

Regarding passwords, it is essential not to store them in plain text. You should hash the password using the bcrypt algorithm before storing it.

Your script should create at least 3 users. Note that there's no need to pre-fill the "last login time" field on creation, as the user may not have signed in yet.

## State Maintenance

Your session should keep track of whether the user is logged in and, if so, store their details. It's suggested to include `session_start()` in your header to ensure it gets called every time a page is displayed.

Additionally, your session should contain information about banners to be displayed. For this assignment, two required banners are error messages on sign-in and a welcome message for the user on the dashboard, including their last login time. Banners should only display once, meaning that if a user navigates back to `/index.php` after seeing the banner, it should not be displayed again (remove the message from the session).

## Site Constants (`constants.php`)

Create a file named `constants.php` that will be included in `header.php`. This file should define all site-wide constants using appropriate `define()` syntax.

You will need to define:

- A single character to refer to the "Administrator" user type (suggested: "a").
- Connection parameters for the database. Consider having one file for local development and one for OpenTech development.

## Database Functions (`db.php`)

Create a file called `db.php`, where you will store your database functions, including:

- `db_connect()`: This function should not take any arguments and should return a PostgreSQL connection resource.
- `user_select(id)`: Takes one argument, `id`, and returns an associative array with that user's information or `false` if the user does not exist.
- `user_authenticate(id, password)`: Takes two arguments, `id` and `password`, and returns an associative array with that user's information or `false` if the user does not exist. If a record is retrieved (i.e., the user has authenticated), update the user's last login time to the current timestamp. Note that `user_authenticate()` should use `password_verify()` to check if the entered password matches the bcrypt hash of the user's password.

## Non-database Functions (`functions.php`)

Store all non-database-related functions in a file named `functions.php`.

## Dynamic Navigation

Your `header.php` page should have a dynamic navigation bar. It should include:

- A link to the Home page (`index.php`) always.
- If no user is logged in, a link to the sign-in page (`sign-in.php`).
- If a user is logged in, a link to the dashboard (`dashboard.php`). The link to login (`sign-in.php`) should change to logout (`logout.php`) in this case.

## Secure Login Functionality (`sign-in.php`)

Create a file called `sign-in.php`. It should include a self-referring form with two inputs: one for an `id` (a text input) and one for a `password` (a password input).

When the form is submitted in POST mode, it should:

- Retrieve the inputted data, removing any leading and trailing whitespace.
- Verify that both fields were entered (display an error otherwise).
- Call the `user_authenticate()` function, passing the inputted data.

If no record is returned, the user should remain on the `sign-in.php` page with a message stating that the user did not authenticate correctly. If a record is retrieved, the user's data should be stored in the session, a successful login message should be placed in the session, and the user should be redirected to `dashboard.php`, where the success message is displayed and then removed from the session.

## Logout Functionality (`logout.php`)

The `logout.php` file should perform the following actions:

- Unset the session.
- Destroy the session.
- Restart the session.
- Place a message stating that the user has successfully logged out in the session.
- Redirect the user to the `sign-in.php` page, where the message from the session should be displayed and then removed from the session.

## Activity Logging

All sign-in activity will be logged to a text file named `DATE_log.txt`, where `DATE` is the current date in `YYYYmmdd` format. A log entry will look like:

_Sign in success at_ &lt;time>. _User_ &lt;email> _sign in._

For this assignment, you will log sign-in, sign-out, and failed sign-in activity.

### [Back to Top](#inft-2100---lab-1)
