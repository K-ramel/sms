CREATE DATABASE IF NOT EXISTS library_system;
USE library_system;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  student_id VARCHAR(50) DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('Admin','Librarian','Student','Teacher') NOT NULL DEFAULT 'Student',
  status ENUM('Pending','Approved','Rejected','Blocked') NOT NULL DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(150) NOT NULL,
  category VARCHAR(100) NOT NULL,
  year YEAR NOT NULL,
  status ENUM('Available','Borrowed') NOT NULL DEFAULT 'Available',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  borrow_date DATETIME NOT NULL,
  due_date DATE NOT NULL,
  return_date DATETIME NULL,
  status ENUM('Pending','Borrowed','Returned') NOT NULL DEFAULT 'Pending',
  CONSTRAINT fk_transactions_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_transactions_book FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS penalties (
  id INT AUTO_INCREMENT PRIMARY KEY,
  transaction_id INT NOT NULL,
  amount DECIMAL(10,2) NOT NULL DEFAULT 0,
  status ENUM('Paid','Unpaid') NOT NULL DEFAULT 'Unpaid',
  CONSTRAINT fk_penalties_transaction FOREIGN KEY (transaction_id) REFERENCES transactions(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS audit_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  action VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, student_id, password, role, status)
VALUES ('System Admin', 'admin@cmic.edu.ph', 'ADM-001', '$2y$10$23Eg2AqM2qbhoh.Qh5vnEe7Jm8jr6D4MQaM3R2jVbJU3jcOQ.HnQW', 'Admin', 'Approved')
ON DUPLICATE KEY UPDATE email = VALUES(email);
