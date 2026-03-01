CREATE DATABASE IF NOT EXISTS cmici_lms;
USE cmici_lms;

CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  school_id VARCHAR(50) NOT NULL,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('Administrator','Librarian','Student','Teacher') NOT NULL,
  department VARCHAR(100) NOT NULL,
  status ENUM('Pending','Active','Rejected') NOT NULL DEFAULT 'Pending',
  created_at DATETIME NOT NULL
);

CREATE TABLE books (
  book_id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(150) NOT NULL,
  category VARCHAR(100) NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  status ENUM('Available','Borrowed') NOT NULL DEFAULT 'Available'
);

CREATE TABLE transactions (
  transaction_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  borrow_date DATE NOT NULL,
  due_date DATE NOT NULL,
  return_date DATE DEFAULT NULL,
  penalty_amount DECIMAL(10,2) NOT NULL DEFAULT 0,
  status ENUM('Requested','Borrowed','Returned') NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (book_id) REFERENCES books(book_id)
);

INSERT INTO users (school_id, fullname, email, password, role, department, status, created_at)
VALUES
('ADMIN-001', 'System Administrator', 'admin@cmici.local', '$2y$10$tN2fYPrQaYxfQq9f2ck8R.WkUpS8y8Xizc/rGhj6s0H.Bo0q8zWyW', 'Administrator', 'IT Department', 'Active', NOW()),
('LIB-001', 'Main Librarian', 'librarian@cmici.local', '$2y$10$tN2fYPrQaYxfQq9f2ck8R.WkUpS8y8Xizc/rGhj6s0H.Bo0q8zWyW', 'Librarian', 'Library', 'Active', NOW());

INSERT INTO books (title, author, category, quantity, status)
VALUES
('Introduction to Algorithms', 'Thomas H. Cormen', 'Computer Science', 5, 'Available'),
('Clean Code', 'Robert C. Martin', 'Software Engineering', 3, 'Available'),
('Operating System Concepts', 'Abraham Silberschatz', 'Computer Science', 2, 'Available');
