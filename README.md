# 🏥 Prescription Quotation System (Laravel)

## 🚀 Setup Instructions

git clone https://github.com/athula-wasala/Prescription-Quotation-System.git
cd Prescription-Quotation-System

composer install

cp .env.example .env
php artisan key:generate

php artisan storage:link

php artisan migrate
php artisan db:seed

php artisan config:clear

npm install
npm run dev

php artisan serve


## 👤 Demo Login Details

Admin:
admin@test.com
password: test@123

Pharmacy:
pharmacy@test.com
password: test@123

Customer:
customer@test.com
password: test@123


## 📧 Mail Setup (Mailpit)

MAIL_HOST=127.0.0.1
MAIL_PORT=1025

Mail UI:
http://127.0.0.1:8025

Used for:
- Prescription notifications
- Quotation emails
- Laravel notifications system


## 🔐 Permission System

This project uses Spatie Laravel Permission package for role-based access control (RBAC).

Roles:
- Admin
- Pharmacy
- Customer

Features:
- Role management
- Route protection
- Access control


## 🔄 System Flow

Customer uploads prescription → Pharmacy creates quotation → Customer accepts/rejects → Notification sent via Mailpit


## 🎯 Features

- Role-based authentication (RBAC)
- Prescription upload system
- Quotation management
- Email notifications (Mailpit)
- Status filtering (Pending / Accepted / Rejected)
- Image upload support


## 🚀 Summary Flow

clone → install → env → key → storage → migrate → seed → npm install → dev → serve
