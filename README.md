# School Management System

A web-based school management system built with PHP and MySQL, featuring admin, teacher, and student panels.

## Features

- Admin dashboard for managing students, teachers, courses, and classes
- Student fee payment tracking (UI-based — no live payment gateway integrated)
- Timetable and attendance management
- Student and parent panel access

## Tech Stack

- PHP
- MySQL
- Bootstrap (AdminLTE theme)
- jQuery

## Setup Instructions

1. Clone this repository into your local server directory (e.g. `htdocs` for XAMPP)
2. Import `school_database.sql` into your MySQL server
3. Copy `includes/config.example.php` to `includes/config.php` and update it with your database credentials
4. Start Apache and MySQL
5. Visit `http://localhost/[project-folder-name]` in your browser

## Notes

This project was built as part of an internship, following a PHP School Management System tutorial series, with custom modifications and bug fixes.