DROP DATABASE diagnostic_db;
CREATE DATABASE diagnostic_db;
USE diagnostic_db;



CREATE TABLE `security_questions` (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question varchar(255) NOT NULL
);

CREATE TABLE `user` (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  age INT NOT NULL,
  address varchar(255) NOT NULL,
  mobile_number varchar(12) NOT NULL
);
CREATE TABLE `user_questions` (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_id INT,
  user_id INT,
  answer varchar(255),
  FOREIGN KEY (question_id) REFERENCES security_questions (id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
);

CREATE TABLE employee (
  
  user_id INT NOT NULL PRIMARY KEY,
  position enum('Cashier','Information Desk Officer') NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
);

CREATE TABLE patient (
  id VARCHAR(255) PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  suffix varchar(50),
  middle_name varchar(50) NOT NULL,
  birthdate date NOT NULL,
  age int(2) NOT NULL,
  province varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  barangay varchar(50) NOT NULL,
  purok varchar(50) NOT NULL,
  subdivision varchar(50) NOT NULL,
  house_no varchar(50) NOT NULL,
  mobile_number varchar(11) NOT NULL,
  image_url varchar(255) NOT NULL,
  gender varchar(11) NOT NULL,
  id_type varchar(255) DEFAULT NULL
  
);
CREATE TABLE payment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  account_number VARCHAR(255),
  amount DECIMAL (10,2) NOT NULL,
  insurance VARCHAR(255) DEFAULT '',
  company VARCHAR(255) DEFAULT '',
  date_paid DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE request (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  patient_id VARCHAR(255),
  status ENUM('Pending', 'Approved', 'Reject', 'Paid') NOT NULL DEFAULT 'Pending',
  request_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  total DECIMAL(10, 2) NOT NULL, 
  comment VARCHAR(255) DEFAULT '',
  payment INT DEFAULT NULL,
  result_date DATETIME,
  FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL
);



CREATE TABLE `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  normal_value VARCHAR(255) DEFAULT ''
);


CREATE TABLE request_services(
  request_id INT NOT NULL,
  service_id INT NOT NULL,
  FOREIGN KEY (request_id) REFERENCES request (id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services (id)
);

CREATE TABLE request_result(
  id INT PRIMARY KEY AUTO_INCREMENT,
  request_id INT NOT NULL,
  service_id INT NOT NULL,
  name VARCHAR(255),
  result VARCHAR(255) DEFAULT NULL,
  FOREIGN KEY (request_id) REFERENCES request (id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services (id)
);



CREATE TABLE appointment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  patient_id VARCHAR(255),
  status ENUM('Pending', 'Approved', 'Reject', 'Paid') NOT NULL DEFAULT 'Pending',
  appointment_date DATE NOT NULL,
  total DECIMAL(10, 2) NOT NULL, 
  comment VARCHAR(255) DEFAULT '',
  datetime_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL
);


CREATE TABLE appointment_services(
  appointment_id INT NOT NULL,
  service_id INT NOT NULL,
  FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services (id)
);
CREATE TABLE package (
  id INT AUTO_INCREMENT PRIMARY KEY,
  package_name VARCHAR(255) NOT NULL,
  package_price INT NOT NULL
);
CREATE TABLE package_services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  package_id INT NOT NULL,
  service_id INT NOT NULL,
  FOREIGN KEY (package_id) REFERENCES package(id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);



DELIMITER //
CREATE TRIGGER before_patient_insert BEFORE INSERT ON patient FOR EACH ROW
BEGIN
  DECLARE next_id INT DEFAULT 1;  -- Initialize counter for daily sequence
  
  SET NEW.id = CONCAT(
    YEAR(CURDATE()), 
    MONTH(CURDATE()), 
    DAY(CURDATE()), 
    (SELECT COUNT(*) FROM patient));
END;
//
DELIMITER ;


--insert security questions
INSERT INTO security_questions (question) VALUES 
  ("What is your mother's maiden name?"), 
  ('What is the name of your first pet?'), 
  ('What is your favorite color?'),
  ('What is the name of the street you grew up on?'),
  ('What is your favorite movie?'),
  ('What is your favorite food?'),
  ('What is your favorite book?'),
  ('What is your favorite hobby?'),
  ('What is your favorite animal?'),
  ('What is your favorite song?');







--services

INSERT INTO `services` (`name`, `price`, `normal_value`) VALUES
('Serum Uric Acid (Female)', 150 , '149-404'),       
(' Serum Creatinine (Female)', 180 , '53-97 '),           
('Serum Uric Acid (Male)', 150 , '214-458'),         
('Serum Creatinine (Male)', 180 , '80-115'),
('Cholesterol total', 150.00, '2.60-4.90 mmol/L'),
('Hemoglobin Determination', 50.00, '120-160 g/dL'),
('Urine Analysis', 50.00, '120-160 g/dL'),
('Complete Blood Count', 50.00, '120-160 g/dL'),
('Glucose', 50.00, '120-160 g/dL'),
('SGPT', 50.00, '23 g/dL');

INSERT INTO  `package` (`package_name`, `package_price`) VALUES
('Blood Chemistry and SGPT (MALE)', 500.00),
('Blood Chemistry (MALE)', 1000.00),
('Blood Chemistry and SGPT (FEMALE)', 500.00),
('Blood Chemistry (FEMALE)', 1000.00);

INSERT INTO `package_services` (package_id, service_id) VALUES 
(1,3),
(1,4),
(1,5),
(1,9),
(1,10),
(2,3),
(2,4),
(2,5),
(2,9),
(3,1),
(3,2),
(3,5),
(3,9),
(3,10),
(4,1),
(4,2),
(4,5),
(4,9);


