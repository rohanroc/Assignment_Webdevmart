
CREATE TABLE emp_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    address VARCHAR(255),
    designation VARCHAR(100),
    salary DECIMAL(10,2),
    picture VARCHAR(255)
);


CREATE TABLE login_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100),
    password VARCHAR(100),
    name VARCHAR(100)
);
