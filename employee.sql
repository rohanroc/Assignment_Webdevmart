CREATE DATABASE IF NOT EXISTS employee_system;
USE employee_system;

CREATE TABLE emp_details (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  address TEXT,
  designation VARCHAR(100),
  salary FLOAT,
  picture VARCHAR(100)
);

CREATE TABLE login_details (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(50) UNIQUE,
  password VARCHAR(100),
  name VARCHAR(100)
);

INSERT INTO login_details (user_name, password, name)
VALUES ('arijit', 'arijit123', 'Administrator');


INSERT INTO emp_details (name, address, designation, salary, picture)
VALUES 
('Arijit Saha', 'Baranagar', 'Software Engineer', 50000.00, 'arijit.jpg');

-- Login check
SELECT * FROM login_details 
WHERE user_name = 'admin' AND password = 'admin123';


-- Add new employee
INSERT INTO emp_details (name, address, designation, salary, picture)
VALUES ('Alice Johnson', '789 Road, TX', 'Accountant', 55000.00, 'alice.jpg');

-- List all employees
SELECT * FROM emp_details;

-- Edit employee
UPDATE emp_details
SET name = 'John Updated',
    address = 'New Address, NY',
    designation = 'Lead Developer',
    salary = 70000.00,
    picture = 'john_updated.jpg'
WHERE id = 1;

-- Delete employee
DELETE FROM emp_details WHERE id = 2;