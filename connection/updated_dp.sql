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
  subdivision varchar(50) NOT NULL,
  house_no varchar(50) NOT NULL,
  mobile_number varchar(11) NOT NULL,
  image_url varchar(255) NOT NULL,
  gender varchar(11) NOT NULL
  
);


CREATE TABLE request (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  patient_id INT,
  status ENUM('Pending', 'Approved', 'Reject', 'Paid') NOT NULL DEFAULT 'Pending',
  request_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  total DECIMAL(10, 2) NOT NULL, 
  comment VARCHAR(255) DEFAULT '',
  payment DECIMAL(10, 2) DEFAULT 0,
  
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
  result VARCHAR(255) DEFAULT '',
  test VARCHAR(255) DEFAULT '',
  FOREIGN KEY (request_id) REFERENCES request (id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services (id)
);


CREATE TABLE appointment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  patient_id INT,
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


INSERT INTO `services` (`name`, `price`, `normal_value`) VALUES
('Glucose(Fasting Blood Sugar)', 100.00, '3.85-5.78 mmol/L'),
('Cholesterol total', 150.00, '2.60-4.90 mmol/L'),
('Serum Uric Acid(SUA)', 150.00, '149-404 μmol/L'),
('Serum Creatinine', 150.00, '53-97 μmol/L'),
('Hemoglobin Count', 50.00, '120-160 g/dL'),
('Hematocrit Count', 50.00, '38-47 %'),
('White Blood Cells', 50.00, '4.5-11.0x10^3/μL'),
 ('Serum Uric Acid (Female)', 150 , '149-404'),       
(' Serum Creatinine (Female)', 180 , '53-97 '),           
 ('Serum Uric Acid (Male)', 150 , '214-458'),         
 ('Serum Creatinine (Male)', 180 , '80-115');

INSERT INTO patient (
  first_name,
  last_name,
  birthdate,
  age,
  province,
  city,
  barangay,
  subdivision,
  house_no,
  purok,
  mobile_number,
  image_url,
  gender
) VALUES
('John', 'Doe', '1990-05-15', 32, 'Province1', 'City1', 'Barangay1', 'NewSubdivision1', 'NewHouseNo1', 'Purok1', '12345678901', 'image_url1.jpg', 'Male'),
('Jane', 'Smith', '1985-08-21', 37, 'Province2', 'City2', 'Barangay2', 'NewSubdivision2', 'NewHouseNo2', 'Purok2', '23456789012', 'image_url2.jpg', 'Female'),
('Mike', 'Johnson', '1995-02-10', 27, 'Province3', 'City3', 'Barangay3', 'NewSubdivision3', 'NewHouseNo3', 'Purok3', '34567890123', 'image_url3.jpg', 'Male'),
('Sarah', 'Williams', '1980-11-03', 42, 'Province4', 'City4', 'Barangay4', 'NewSubdivision4', 'NewHouseNo4', 'Purok4', '45678901234', 'image_url4.jpg', 'Female');

INSERT INTO `user` (first_name, last_name, username, password, age, address, mobile_number)
VALUES ('John', 'Doe', 'johndoe', 'password123', 30, '123 Main St', '1234567890');


INSERT INTO `request` (user_id, patient_id, status, total)
VALUES
(1, 1, 'Pending', 150.00),
(1, 2, 'Pending', 200.00),
(1, 3, 'Pending', 100.00),
(1, 4, 'Pending', 250.00);

-- Inserting sample data into the `request_services` table
INSERT INTO `request_services` (request_id, service_id )
VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(3, 5),
(4, 6),
(4, 7);



-- Inserting sample data into the `appointment` table
INSERT INTO `appointment` (user_id, patient_id, status, appointment_date, total)
VALUES
(1, 2, 'Pending', '2023-11-30', 150.00),
(1, 2, 'Pending', '2023-12-01', 200.00),
(1, 3, 'Pending', '2023-12-02', 100.00),
(1, 4, 'Pending', '2023-12-03', 250.00);

-- Inserting sample data into the `appointment_services` table
INSERT INTO `appointment_services` (appointment_id, service_id)
VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(3, 6),
(3, 7),
(3, 5);