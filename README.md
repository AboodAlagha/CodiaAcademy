## Introduction

 Component of the global educational and developmental paradigm, fundamentally reshaping the acquisition of knowledge and the cultivation of skills. E-learning platforms present unparalleled opportunities for lifelong learning, effectively surmounting the geographical and temporal constraints that have historically hindered conventional pedagogical models. This technological evolution underscores a pressing imperative within the Arab world for advanced software solutions tailored to service this burgeoning sector.
It is from this strategic standpoint that the "Codia Academy" project was conceived. It is conceptualized as a software solution engineered to deliver an integrated, secure, and user-centric educational environment specifically for the Arabic-speaking demographic. 
The project's scope extends beyond the mere development of a technical platform; it seeks to cultivate a vibrant digital learning community. This community will facilitate a nexus between Arab subject-matter experts and instructors, and a broad audience of students and professionals aspiring to enhance their competencies, thereby making a substantive contribution to the advancement of the region's knowledge-based economy

---

## How to Run the Project Locally

Follow the steps below to set up and run the project in your local environment:

### 1. Requirements

Before you begin, make sure the following tools are installed on your system:

* [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/)
* Web browser (Google Chrome, Firefox, etc.)
* Text editor (VS Code, Sublime Text, etc.)

---

### 2. Clone the Repository

Clone this repository into your local web server’s directory:

```bash
# Example (for XAMPP users)
C:\xampp\htdocs\
```

You can clone it using Git:

```bash
git clone https://github.com/yourusername/yourprojectname.git
```

Or simply download the ZIP file and extract it into the `htdocs` (for XAMPP) or `www` (for WAMP) folder.

---

### 3. Create the Database

1. Open **phpMyAdmin** from your XAMPP/WAMP control panel.
2. Click on **New** and create a new database.

**Important Note:**
The database name **must exactly match** the name defined in the project’s configuration file and the provided `.sql` file.
For example, if the SQL file is named `elearning_system.sql`, then your database **must also be named**:


3. After creating the database, import the SQL file:

   * Go to the **Import** tab.
   * Click **Choose File** and select the provided SQL file (e.g., `elearning_system.sql`).
   * Click **Go** to import all tables and data.

---

### 4. Configure Database Connection

Open the project folder and locate the configuration file:

```
/config.php
```

Make sure the connection settings are correct:

```php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "";
```

*If you’re using a custom password or port for MySQL, update the values accordingly.*

---

### 5. Start the Server

Launch **Apache** and **MySQL** from your XAMPP/WAMP control panel.

---

### 6. Access the Project

Open your web browser and visit:

```
http://localhost/yourprojectname/
```

---

### 7. Admin Panel (Optional)

If the project includes an admin dashboard, open:

```
http://localhost/yourprojectname/admin/
```

Default credentials (if provided in the SQL file):

```
Email: admin@codia.ps
Password: admin
```

---

### 8. Troubleshooting

If the project doesn’t load properly:

* Make sure Apache and MySQL are running.
* Confirm that the **database name matches** the SQL file and `config.php`.
* Check that your SQL import completed successfully.
* Enable any missing PHP extensions in `php.ini`.

---

ه
