
# Laravel Mini Inventory & Sales Management System

Inventory & Sales Management System built with Laravel-12, Bootstrap, MySQL, and Blade Template Engine.

---

## Preview Features

* Authentication System
* Dashboard Analytics
* Category Management
* Product Management
* Customer Management
* Sales & Invoice System
* Printable Invoice
* Stock Management
* Pagination
* Soft Delete
* Search & Filter

---

## Tech Stack

| Technology | Version |
| ---------- | ------------- |
| PHP | 8.2+ |
| Laravel | 12 |
| MySQL | Latest |
| Bootstrap | 5 |
| Blade | Laravel Blade |
| jQuery | Latest |

---

# Features

## Authentication

* Login
* Registration
* Logout
* Protected Dashboard

---

# Dashboard

Dashboard includes:

* Total Products
* Total Customers
* Total Sales
* Total Revenue
* Low Stock Products

---
## Low Stock Product Alert

The system automatically shows a **Low Stock Product List** when product quantity becomes less than 5.

### Features

- Automatically detect low stock products
- Show warning list on dashboard

### Example

| Product Name | Stock Quantity | Status |
|--------------|----------------|--------|
| Mouse | 3 | Low Stock |
| Keyboard | 2 | Low Stock |
| Monitor | 1 | Low Stock |

# Category Module

* Create Category
* Update Category
* Delete Category
* Pagination
* Soft Delete

---

# Product Module

* Product CRUD
* Product Image Upload
* SKU Management
* Stock Quantity
* Product Status
* Category Relationship
* Pagination
* Soft Delete

---

# Customer Module

* Customer CRUD
* Unique Phone Validation
* Search Customer

---

# Sales Module

* Create Invoice
* Select Customer
* Add Multiple Products
* Product Quantity
* Auto Calculate Total
* Discount Option
* Grand Total
* Reduce Stock After Sale
* Prevent Selling More Than Available Stock
* Store Invoice Records

---

# Invoice System

* Generate Invoice Page
* Printable Invoice
* Customer Information
* Product List
* Quantity
* Price
* Subtotal
* Total
* Discount
* Grand Total

---

# Technologies Used

* Laravel
* PHP
* MySQL
* Bootstrap 5
* Blade Template
* jQuery

---

# Requirements

Before running the project, make sure these are installed:

## Required Software

* PHP 8.2+
* Composer
* MySQL
* Node.js
* Git
* XAMPP / Laragon

---

# Installation Guide

## Step 1: Clone Project

Open terminal:

```bash
git clone https://github.com/rbrazib77/laravelAssessment.git
```

---

## Step 2: Enter Project Folder

```bash
cd your-project-name
```

---

## Step 3: Install Composer Dependencies

```bash
composer install
```

---

## Step 4: Install NPM Dependencies

```bash
npm install
```

---

## Step 5: Create Environment File

```bash
cp .env.example .env
```

---

# Database Setup

## Step 6: Create Database

Create a database from phpMyAdmin.

Example:

```text
laravelAssessment
```

---

## Step 7: Configure .env File

Open `.env` file and update:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelAssessment
DB_USERNAME=root
DB_PASSWORD=
```

---

## Step 8: Generate Application Key

```bash
php artisan key:generate
```

---

## Step 9: Run Migration

```bash
php artisan migrate
```

---

# Run Project

## Step 11: Start Development Server

```bash
php artisan serve
```

Project URL:

```text
http://127.0.0.1:8000
```

---

# Run Vite Server

Open another terminal:

```bash
npm run dev
```

---

# Login Information

```text
Email: admin@gmail.com
Password: password
```

---

# Important Commands

## Clear Cache

```bash
php artisan optimize:clear
```

## Problem: Server Not Running

Run:

```bash
php artisan serve
```

---

## Problem: Cache Issue

Run:

```bash
php artisan optimize:clear
```

---


# Author

Razib Hossain

---

# License

This project is open-source and available for learning purposes.
