# Custom PHP MVC Library Management System

## Folder Structure

```
library-management-system/
├── app/
│   ├── controllers/
│   ├── core/
│   ├── models/
│   └── views/
├── config/
├── database/
└── public/
```

## Setup

1. Import `database/schema.sql` into MySQL.
2. Update `config/config.php` DB credentials.
3. Point web server document root to `public/`.
4. Login with: `admin@library.local` / `admin123`.

> Default admin password hash in SQL is for `admin123`.
