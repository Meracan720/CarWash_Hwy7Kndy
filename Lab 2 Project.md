# Assignment: Lab 2

Congratulations on completing Lab 1! Before starting Lab 2, it's recommended that you make a copy of Lab 1 since you'll be making modifications and building upon it. It's a good practice to keep a record of your previous work. Using Git Hub or a Git repository is a great way to do this, although it's not mandatory. Feel free to reach out if you want to learn more about it voluntarily.

## What have we done?

In Lab 1, we have achieved the following:

- Login/Logout capabilities
- Database-related functions file (db.php)
- Non-Database-related functions file (functions.php)
- A header and footer with a Bootstrap template (header.php and footer.php)
- Dynamic navigation bar

## What are we looking to do?

We aim to add new functionality to the existing Lab 1 app. This new functionality will include:

- A page for adding new salespeople (users)
- A page for adding new clients (new table)
- A page for tracking user calls (new table)
- New tables to support this new functionality.
- Introducing a new user type (Salespeople) with different access compared to the existing ADMIN user type.

### New database table: Clients

We need a new table for CLIENTS to track the following information:

- PhoneNumber (required)
- Extension (optional)
- Email Address (required)
- First Name (required)
- Last Name (required)
- A unique key, perhaps a Client ID (required)

### New database table: Calls

We need a new table for tracking CALLS, which should contain the following information:

- Date and Time of the call (required, datetime)
- Notes (optional)
- Reference to the CLIENTS the call was with (required)
  - This should be RELATED to the Clients table using a FOREIGN KEY relationship
  - This is NOT optional.

You are expected to add 3 salespeople to a new .SQL file called `salespeople.sql` similar to what you did in LAB1. You will also add `clients.sql` to your project for creating the Clients table and inserting 3 Clients, with each new client belonging to one of the new Salespeople you created. You can hard code the UserID on the Clients table. Finally, create a `calls.sql` file to create the Calls table as outlined, including the foreign key constraint to Client. No Calls need to be inserted.

Let's make the pages more efficiently by writing a function to generate the form contents. The resulting HTML code will look like this:

1. The red boxes 1 and 2 are coded in your `clients.php` or `calls.php`.
2. Each of the yellow boxes contains code generated using array items passed into your function. Avoid hard coding these values. Attributes like id, name, value, and placeholder should come from the array/object properties. The label contents should also be derived from the array object properties.
3. This function will be called in your `salespeople.php`, `clients.php`, and `calls.php`.

## Can we create the pages now?

Certainly! Here are the pages to be created:

### Salespeople.php

- Users must be logged in.
- Only ADMIN users can access this page.
- If neither of these conditions is met, redirect to the sign-in page with an appropriate message.
- The page will have a self-referring form.
- The form's contents will be generated using the `display_form` function.
- Fields will correspond to user table fields, except for the auto number key field.
- When the form is submitted, validate the fields according to table requirements.
- If valid, a new salesperson (user) will be created.
- If invalid, display appropriate error messages, and keep all fields except the password "sticky" (retain their values after a postback).
- Add a new link in the dynamic Nav bar for "Salespeople," which should only be visible for users with the type "admin."

### Clients.php

- This is a self-referring form for inputting data into the Clients table.
- The form tag is included in the `clients.php` code.
- The contents of the form tag should be generated using the `display_form` function.
- Clients can be created by ADMIN or Salespeople, making this page accessible to both.
- The link to `clients.php` ("Clients") will appear in the nav bar for either user type.
- If the logged-in user is a SalesPerson type, the new client entry will be associated with the current user's ID (NOT email).
- If the logged-in user is an ADMIN type, a dropdown or select should be used to choose the associated user.
- This dropdown will contain a list of all users, with the display showing their names and the value attribute set to their IDs, which can be retrieved via a `db.php` function.
- Upon submission, regardless of user type, the data will be validated.
- If valid, a client is created, and a success message is displayed.
- If invalid, error messages are shown, and valid values remain "sticky" (they are retained after a postback).
- The page is accessible to Salespeople and ADMINs but restricted to logged-in users; otherwise, redirect to the sign-in page with an appropriate message.

### Calls.php

- This is also a self-referring form for inputting data into the Calls table.
- The form tag is included in the `calls.php` code.
- The form contents should be generated using the `display_form` function.
- Fields on the form should match the database table requirements.
- This page is accessible to all user types but requires users to be logged in.
- Clients should be selected from a SELECT/DROPDOWN, loaded using the same functionality as `Clients.php` when you're an ADMIN user.
- Form validation should behave similarly to other pages.
- A success or error message should be displayed upon submission.

## Other Resources

- [Dropdown/SELECT usage](https://www.w3schools.com/tags/tag_select.asp)
- [Foreign key relationships/constraints](https://www.postgresqltutorial.com/postgresql-tutorial/postgresql-foreign-key/)
- [PHP Loops](https://www.w3schools.com/php/php_looping.asp), specifically for and foreach.

## Submission Guidelines

- Run any inserts/modifications against `opentech`.
- Place `lab2` in a folder inside your main folder on `opentech` so that `lab1` and `lab2` are both still available at `/lab1` and `/lab2`.
- Zip up the contents of your folder and submit to DCConnect with your link in the Submission Text.
- Failure to do so will result in a loss of marks.
