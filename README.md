Module: 5CS045 – Full Stack Development

Assessment: Task 2 – Full Site Implementation

Student Name: Jeshika Thapaliya

Student ID: np02cs4a240089

University ID: 2505467

**1. Project Overview**

This project is a dynamic and secure PHP + MySQL blog system developed as part of the Full Stack Development module.
The website allows users to view blog posts, while authenticated administrators can manage content using full CRUD operations.
The system follows secure coding practices and includes AJAX functionality for improved user experience.

**2. Technologies Used**

* Backend: PHP

* Database: MySQL

* Database Access: PDO (Prepared Statements)

* Frontend: HTML, CSS, JavaScript

* AJAX: Fetch API

* Security: SQL Injection prevention, XSS protection, CSRF tokens

* Version Control: Git

**3. Features Implemented**

*>Core Features*

* Create, Read, Update, and Delete (CRUD) blog posts

* Category management

* Comment system

* User authentication (login/logout)

* Admin dashboard

*>Search Functionality*

* AJAX-based live search for blog posts

* Results update dynamically without page reload

*>Security Features*

* SQL Injection Protection: PDO prepared statements

* XSS Protection: Output escaping using htmlspecialchars()

* CSRF Protection: Session-based CSRF tokens

* Authentication Protection: Restricted admin access

*>AJAX Features*

* Live search using AJAX

* Asynchronous comment submission

**4. Folder Structure**
   
Blog System/

├── config/

│   └── db.php

├── includes/

│   ├── header.php

│   ├── footer.php

│   └── functions.php

├── public/

│   ├── index.php

│   ├── post.php

│   ├── add_post.php

│   ├── edit_post.php

│   ├── delete_post.php

│   ├── search_ajax.php

│   ├── add_comment_ajax.php

│   ├── login.php

│   ├── logout.php

│   └── admin.php

**5. Database Setup Instructions**

1.Open phpMyAdmin

2.Create a database named:

np02cs4a240089

3.Import the provided SQL file:

np02cs4a240089.sql

4.Update database credentials in:

config/db.php

**6. Admin Login Credentials**

Username: admin

Password: admin123

(Password is stored securely using password hashing)

**7. Admin Setup (admin.php)**

* admin.php was used as a one-time admin setup file to create the initial admin account.

* Passwords are hashed using password_hash().

* The file is protected to prevent unauthorized access.

**8. Hosting Information**

The website is hosted on the school’s student server.

Live URL:  student.bicnepal.edu.np/~np02cs4a240089

**9. How to Use the System**

* Visitors can browse, search blog posts and give feedback

Admin users can:

* Add new posts

* Edit existing posts

* Delete posts

* Manage categories

Comments can be added using AJAX without refreshing the page

**10. Known Issues**

• No uniqueness constraints are applied at the database level for post titles.

11. Declaration

This project is my own work and was developed in accordance with the module guidelines. 
AI tools were used only for learning support and clarification. 
All code was written, understood, and tested by the author without the use of CMS or frameworks.


