# LECTURE EXAMINATION # 4 (Documentation)

## Entity Relationship Diagram

![ERD](https://github.com/Kriz181/final_project_db/blob/main/ERD.png?raw=true)

## Overview

The CRUD (Create, Read, Update, Delete) system is a basic web application for managing employee information. It allows users to perform operations such as adding new employees, viewing a list of employees, updating employee details, and deleting employees.

## Table Structure

The application is based on a MySQL database with a table named `employee` containing the following fields:

- `employee_id` (int, primary key, auto-increment)
- `first_name` (varchar)
- `last_name` (varchar)
- `position` (varchar)
- `office_id` (int)
- `category` (varchar)

## Functions

### 1. Display Employee List

- **File:** `index.php`
- **Description:** Displays a table of employees with their details, including options to edit and delete each entry.
- **Functionality:**
  - Fetches employee data from the database (`SELECT * FROM employee`).
  - Generates an HTML table with employee details.
  - Provides "Edit" and "Delete" links for each employee.

### 2. Create/Update Employee

- **File:** `index.php`
- **Description:** Allows users to add a new employee or update an existing one.
- **Functionality:**
  - Displays a form with fields for `first_name`, `last_name`, `position`, `office_id`, and `category`.
  - Two buttons for "Create" and "Update" operations.
  - Validates form input to ensure all fields are filled.

### 3. Edit Employee

- **File:** `edit.php`
- **Description:** Enables the modification of an existing employee's details.
- **Functionality:**
  - Retrieves employee data based on the provided `employee_id`.
  - Displays a form pre-filled with the employee's current details.
  - Supports the update operation by submitting the form.

### 4. Delete Employee

- **File:** `delete.php`
- **Description:** Allows the deletion of an employee after confirmation.
- **Functionality:**
  - Displays a confirmation message with the employee's details.
  - Offers a "Delete" button to proceed with the deletion.
  - Redirects to `index.php` after a successful delete.

## Database Connection

- **Database:** MySQL
- **Connection:** PDO (PHP Data Objects) is used to establish a connection between PHP and MySQL.

## Setup Instructions

1. Set up a MySQL database named `lb1` with the required table structure (`employee`).
2. Update the database connection details in the PHP files (`$host`, `$dbname`, `$username`, `$password`).
3. Access the application through a web server (e.g., Apache or Nginx) by navigating to the appropriate URL.
