#  EduCare – School Management System

A simple **School Management System** built using **PHP (OOP)** without a database.  
The project demonstrates core backend concepts such as authentication, role-based access, and object-oriented programming.

---

##  Features

### Authentication System
- Login & Signup (Session-based)
- Role-based access:
  - **Admin**
  - **Teacher**
  - **Student**

---

### Admin Dashboard
- View all teachers
- View classes and students
- Teacher of the month

---

### Teacher Dashboard
- View assigned classes
- Manage lessons
- View schedule and attendance
- Recent lessons overview

---

###  Student Dashboard
- View personal info
- View grades
- View schedule
- Notifications system

---

## OOP Implementation

The system uses Object-Oriented Programming:

### `Person.php`
Base class:
- id
- name
- email

### `Student.php`
Extends `Person`:
- grade
- average

### `Teacher.php`
Extends `Person`:
- subject
- active status

---

## Technologies Used

- PHP (OOP)
- HTML / CSS
- JavaScript
- Sessions (for authentication)

---

## Test Accounts

### Admin

Email: admin@educare.com

Password: admin123
Role: Admin


### Teacher

Email: teacher@test.com

Password: 123
Role: Teacher


### Student

Email: student@test.com

Password: 123
Role: Student


---

## Notes

- No database is used (data is stored in sessions)
- Designed for learning purposes (PHP + OOP)
- Role-based UI changes dynamically

---

## Contributors

- Jona Mehmeti  
- Kron Pajaziti  
- Jona Elezi  

---

## Project Goal

This project was built to demonstrate:
- Understanding of **PHP sessions**
- Use of **OOP (Inheritance, Classes)**
- Role-based system design
- Basic full-stack structure without a database

---
