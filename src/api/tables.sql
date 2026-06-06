
DROP DATABASE IF EXISTS school;
CREATE DATABASE IF NOT EXISTS school;

CREATE TABLE IF NOT EXISTS school.users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(45) UNIQUE,
    pass TEXT,
    user_role CHAR(15)
);

CREATE TABLE IF NOT EXISTS school.teachers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(45),
    phone_number VARCHAR(12) UNIQUE,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS school.students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(45),
    curp VARCHAR(18), 
    phone_number VARCHAR(12) UNIQUE,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS school.subjects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    subject_name VARCHAR(70),
    teacher_id INT,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id)
);

CREATE TABLE IF NOT EXISTS school.attendances (
    id INT PRIMARY KEY AUTO_INCREMENT,
    att_date DATE,
    subject_id INT,
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);

CREATE TABLE IF NOT EXISTS school.attendances_details(
    id INT PRIMARY KEY AUTO_INCREMENT,
    attendance_id INT,
    student_id INt,
    status TINYINT(1),
    FOREIGN KEY (attendance_id) REFERENCES attendances(id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS school.scores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    parcial_1 INT,
    parcial_2 INT,
    parcial_3 INT,
    final_avg INT,
    subject_id INT,
    student_id INT,
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS school.groups (
    id INT PRIMARY KEY AUTO_INCREMENT,
    group_name CHAR(2) UNIQUE, 
    teacher_id INT,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id)
);

CREATE TABLE IF NOT EXISTS school.groups_students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    enrollment_date DATE,
    student_id INT,
    group_id INT, 
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES groups(id)
);

INSERT INTO school.users (email, pass, user_role) VALUES 
('carlossalgado@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'TEACHER'),
('jonathanbonilla@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'TEACHER'),
('juanito_pro@gmail.com', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'ADMIN');

INSERT INTO school.teachers (full_name, phone_number, user_id) VALUES 
('Carlos Salgado', '2481366425', 1),
('Jonathan Bonilla', '2481167087', 2);

INSERT INTO school.subjects (subject_name, teacher_id) VALUES 
('Implementa bases de datos', 1),
('Matematicas', 2);

INSERT INTO school.groups (group_name, teacher_id) VALUES 
('4A', 1),
('4B', 2);

INSERT INTO school.users (email, pass, user_role) VALUES 
('alumno.uno@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('alumno.dos@cetis17.edu.mx', 'xx$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfGx', 'STUDENT');

INSERT INTO school.students (full_name, curp, phone_number, user_id) VALUES 
('Juan Pérez', 'PERJ080101HDFRRN01', '5550001111', 3),
('María López', 'LOPM080202MDFRRN02', '5550002222', 4);

INSERT INTO school.groups_students (enrollment_date, student_id, group_id) VALUES 
('2026-06-03', 1, 1),
('2026-06-03', 2, 1);