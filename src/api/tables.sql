
DROP DATABASE IF EXISTS school;
CREATE DATABASE IF NOT EXISTS school;

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
    FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS school.attendances (
    id INT PRIMARY KEY AUTO_INCREMENT,
    att_date DATE,
    subject_id INT,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS school.attendances_details(
    id INT PRIMARY KEY AUTO_INCREMENT,
    attendance_id INT,
    student_id INT,
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
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS school.groups (
    id INT PRIMARY KEY AUTO_INCREMENT,
    group_name CHAR(2) UNIQUE, 
    teacher_id INT,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS school.groups_students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    enrollment_date DATE,
    student_id INT,
    group_id INT, 
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE
);

INSERT INTO school.users (email, pass, user_role) VALUES 
('admin@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'ADMIN'),
('aaron.juarez@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'TEACHER'),
('ana.alatorre@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'TEACHER'),
('kevin.rodriguez@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'TEACHER'),
('blanca.cardona@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'TEACHER'),
('jemin.gonzales@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'TEACHER'),
('angel.tapia@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('daniel.cruz@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('jonathan.bonilla@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('carlos.salgado@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('haziel.morales@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('itzeli.cahuantzi@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('dana.perez@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('allison.flores@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('daniel.gonzales@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('edgar.palomares@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('mario.castillo@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('sofia.vargas@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('luis.ramirez@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('fernanda.lopez@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT'),
('roberto.gomez@cetis17.edu.mx', '$2y$10$dUPPzjvLTCmLmHm.Qf6ob.wmB76b3CdrgH/4yvFVlEPv0RCzIUyfG', 'STUDENT');

INSERT INTO school.teachers (full_name, phone_number, user_id) VALUES 
('Aaron Juarez', '2220000001', 2),
('Ana Lilia Alatorre', '2220000002', 3),
('Kevin Daniel Rodriguez', '2220000003', 4),
('Blanca Yael Cardona', '2220000004', 5),
('Jemin Gonzales', '2220000005', 6);

INSERT INTO school.students (full_name, curp, phone_number, user_id) VALUES 
('Angel Gabriel Tapia', 'TAPA080101HDFRRN01', '5551000001', 7),
('Daniel de Jesus Cruz', 'CRUD080101HDFRRN02', '5551000002', 8),
('Jonathan Bonilla', 'BONJ080101HDFRRN03', '5551000003', 9),
('Carlos Salgado', 'SALC080101HDFRRN04', '5551000004', 10),
('Haziel Morales', 'MORH080101HDFRRN05', '5551000005', 11),
('Itzeli Cahuantzi', 'CAHI080101MDFRRN06', '5551000006', 12),
('Dana Paola Perez', 'PERD080101MDFRRN07', '5551000007', 13),
('Allison Flores', 'FLOA080101MDFRRN08', '5551000008', 14),
('Daniel Gonzales', 'GOND080101HDFRRN09', '5551000009', 15),
('Edgar Palomares', 'PALE080101HDFRRN10', '5551000010', 16),
('Mario Castillo', 'CASM080101HDFRRN11', '5551000011', 17),
('Sofia Vargas', 'VARS080101MDFRRN12', '5551000012', 18),
('Luis Ramirez', 'RAML080101HDFRRN13', '5551000013', 19),
('Fernanda Lopez', 'LOPF080101MDFRRN14', '5551000014', 20),
('Roberto Gomez', 'GOMR080101HDFRRN15', '5551000015', 21);

INSERT INTO school.subjects (subject_name, teacher_id) VALUES 
('Matematicas', 1),
('Ingles', 2),
('Lengua y comunicacion', 2),
('Base de datos', 3),
('Base de datos no relacionales', 3),
('Historia', 4),
('Ingles II', 4),
('Recursos socioemocionales', 4),
('Diseña software', 5),
('Recursos socioemocionales II', 5),
('Matematicas II', 5),
('Cultura digital', 5);

INSERT INTO school.groups (group_name, teacher_id) VALUES 
('4A', 1),
('2A', 2),
('2B', 3);

INSERT INTO school.groups_students (enrollment_date, student_id, group_id) VALUES 
('2026-02-01', 1, 1), ('2026-02-01', 2, 1), ('2026-02-01', 3, 1), ('2026-02-01', 4, 1), ('2026-02-01', 5, 1),
('2026-02-01', 6, 2), ('2026-02-01', 7, 2), ('2026-02-01', 8, 2), ('2026-02-01', 9, 2), ('2026-02-01', 10, 2),
('2026-02-01', 11, 3), ('2026-02-01', 12, 3), ('2026-02-01', 13, 3), ('2026-02-01', 14, 3), ('2026-02-01', 15, 3);

INSERT INTO school.attendances (att_date, subject_id) VALUES 
('2026-06-01', 4),
('2026-06-02', 4),
('2026-06-03', 4),
('2026-06-04', 4),
('2026-06-05', 4);

INSERT INTO school.attendances_details (attendance_id, student_id, status) VALUES 
(1, 11, 1), (1, 12, 1), (1, 13, 1), (1, 14, 1), (1, 15, 0),
(2, 11, 1), (2, 12, 1), (2, 13, 1), (2, 14, 1), (2, 15, 1),
(3, 11, 1), (3, 12, 0), (3, 13, 1), (3, 14, 1), (3, 15, 1),
(4, 11, 1), (4, 12, 1), (4, 13, 1), (4, 14, 1), (4, 15, 1),
(5, 11, 1), (5, 12, 1), (5, 13, 0), (5, 14, 1), (5, 15, 0);

INSERT INTO school.scores (parcial_1, parcial_2, parcial_3, final_avg, subject_id, student_id) VALUES 
(8, 9, 10, 9, 1, 1),
(7, 7, 8, 7, 1, 2),
(10, 10, 9, 10, 1, 3),
(9, 8, NULL, NULL, 9, 1),
(6, NULL, NULL, NULL, 9, 4),
(10, 9, NULL, NULL, 9, 5),
(8, 8, 8, 8, 4, 11),
(7, 9, NULL, NULL, 4, 12),
(5, 6, 7, 6, 4, 13);