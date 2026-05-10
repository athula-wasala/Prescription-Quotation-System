#  Pharmacy Prescription Management System

---

##  Project Setup

### 1. Clone Project
git clone <repo-url>

### 2. Install Dependencies
composer install

### 3. Environment Setup
cp .env.example .env
Update DB details in .env

### 4. Generate Key
php artisan key:generate

### 5. Run Migrations
php artisan migrate

### 6. Run Seeder
php artisan db:seed
OR
php artisan db:seed --class=RoleSeeder

### 7. Storage Link
php artisan storage:link

### 8. Run Server
php artisan serve

---

## 📧 Mail Setup (Mailpit)

MAIL_HOST=127.0.0.1  
MAIL_PORT=1025  

Mail UI:
http://127.0.0.1:8025

---

## 👨‍💻 Developer Info

- Framework: Laravel 10+
- Language: PHP 8+
- Database: MySQL
- UI: Blade + Tailwind
- Auth: Laravel Auth
- Roles: Spatie Permission

---

## 🧪 Testing

### Test Users:
- Admin → manage users
- Pharmacy → create quotations
- Customer → upload prescriptions

### Test Flow:
1. Register user
2. Assign role
3. Login
4. Test features based on role

---

## 🎯 System Flow

register → login → role check → dashboard → actions

---

## 📌 Key Features

✔ Role-based access (Admin, Pharmacy, Customer)  
✔ Prescription upload system  
✔ Quotation system  
✔ Email notifications (Mailpit)  
✔ Status filtering (Pending / Accepted / Rejected)  

---

## 🚀 Summary Command Flow

clone → install → env → key → migrate → seed → storage → serve