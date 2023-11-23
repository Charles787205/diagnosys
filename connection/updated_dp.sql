
DROP DATABASE diagnostic_db;
CREATE DATABASE diagnostic_db;
USE diagnostic_db;

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
CREATE TABLE employee (
  
  user_id INT NOT NULL PRIMARY KEY,
  position enum('Cashier','Information Desk Officer') NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
);

CREATE TABLE patient (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  birthdate date NOT NULL,
  age int(2) NOT NULL,
  province varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  barangay varchar(50) NOT NULL,
  purok varchar(50) NOT NULL,
  mobile_number varchar(11) NOT NULL,
  image_url varchar(255) NOT NULL,
  gender varchar(11) NOT NULL
  
);


CREATE TABLE `request` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  `patient_id` INT NOT NULL,
  status enum('Pending','Approved','Reject','Paid') NOT NULL DEFAULT 'Pending',
  request_date date NOT NULL DEFAULT current_timestamp(),
  `total` INT NOT NULL,
  FOREIGN KEY (patient_id) REFERENCES patient (id),
  FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
);


CREATE TABLE request_services(
  request_id INT NOT NULL,
  service_id INT NOT NULL,
  result VARCHAR(255) DEFAULT '',
  normal_value VARCHAR(255) DEFAULT '',
  FOREIGN KEY (request_id) REFERENCES request (id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services (id)
);


CREATE TABLE appointment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  patient_id INT NOT NULL,
  status enum('Pending','Approved','Reject','Paid') NOT NULL DEFAULT 'Pending',
  appointment_date DATE NOT NULL,
  total INT NOT NULL,
  FOREIGN KEY (patient_id) REFERENCES patient (id),
  FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE appointment_services(
  appointment_id INT NOT NULL,
  service_id INT NOT NULL,
  FOREIGN KEY (appointment_id) REFERENCES appointment (id),
  FOREIGN KEY (service_id) REFERENCES services (id)
);


INSERT INTO `services` (`id`, name, `price`) VALUES
(1, 'CBC', 100),
(2, 'Hemoglobin', 200),
(3, 'Platelet Count', 300),
(4, 'Blood Typing', 400),
(5, 'HBsAG', 500),
(6, 'VDRL/Syphilis', 600),
(7, 'HA1c  ', 700),
(8, 'TSH    ', 800),
(9, 'T3', 900),
(10, 'URINE ANALYSIS', 1000),
(11, 'Fecalysis', 1100),
(12, 'FBS', 1200),
(13, 'RBS', 1300),
(14, 'LIPID PROFILE', 1400),
(15, 'CHOLESTEROL', 1500),
(16, 'SUA', 1600),
(17, 'GREATININE', 1700),
(18, 'SGPT/ALT ', 1800),
(19, 'SGOT/AST   ', 1900),
(20, 'BUN', 2000),
(21, 'ELECTROLYTES', 2100);

