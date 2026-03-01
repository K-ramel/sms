# CMICI Library Management System (Custom PHP MVC)

This is a **custom-built PHP MVC framework** implementation of the Library Management System (not Laravel), based on your SRS.

## Included Modules

- Authentication (registration, login, logout)
- Role-based dashboards (Administrator, Librarian, Student, Teacher)
- Admin: account approval, book management, reports, penalty overview
- Librarian: borrow/return confirmation, penalty monitoring
- Student/Teacher: OPAC search, borrow request, borrowing history
- LAN-only restriction guard for OPAC/system access

## Tech Stack

- PHP 8+
- MySQL
- Bootstrap 5
- Custom MVC (`app/Core`, `app/Controllers`, `app/Models`, `app/Views`)

## Setup

1. Create database/tables:
   ```bash
   mysql -u root -p < database/schema.sql
   ```
2. Edit DB credentials in `config/database.php`.
3. Serve app (point document root to `custom-lms/public`):
   ```bash
   php -S 0.0.0.0:8080 -t public
   ```
4. Open `http://localhost:8080` from LAN.

## Seeded Accounts

- Admin: `admin@cmici.local`
- Librarian: `librarian@cmici.local`
- Password for seeded accounts: `password123`

## Folder Structure

- `public/index.php` – front controller
- `app/Core` – routing, DB, auth, LAN guard, base MVC classes
- `app/Controllers` – feature controllers by role
- `app/Models` – data access classes
- `app/Views` – Bootstrap templates
- `database/schema.sql` – schema + seed data

