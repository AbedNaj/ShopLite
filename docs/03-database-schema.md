# 📊 Database Schema – ShopLite

This document describes the database structure of the ShopLite E-Commerce system for physical products.

---
## 🧑 Roles

| Column     | Type      | Description               |
|------------|-----------|---------------------------|
| id         | UUID      | Primary key               |
| name       | string    | Role name (admin, customer...) |
| created_at | timestamp |                           |



## 🧑 Users

| Column     | Type      | Description                         |
|------------|-----------|-------------------------------------|
| id         | UUID      | Primary key                         |
| name       | string    | Full name                           |
| email      | string    | Unique                              |
| password   | string    | Hashed password                     |
| role_id    | UUID (FK) | Foreign key to `roles` table        |
| created_at | timestamp |                                     |

---

## 📇 Customers (Profiles)

| Column      | Type      | Description                       |
|-------------|-----------|-----------------------------------|
| id          | UUID      | Primary key                       |
| user_id     | UUID (FK) | Links to `users` table            |
| phone       | string    | Customer phone number             |
| address     | text      | Default shipping address          |
| city        | string    | Optional                          |
| postal_code | string    | Optional                          |
| created_at  | timestamp |                                   |

---

## 📁 Categories

| Column     | Type      | Description       |
|------------|-----------|-------------------|
| id         | UUID      | Primary key       |
| name       | string    | Category name     |
| created_at | timestamp |                   |

---

## 📂 SubCategories

| Column      | Type      | Description                   |
|-------------|-----------|-------------------------------|
| id          | UUID      | Primary key                   |
| name        | string    | Subcategory name              |
| category_id | UUID (FK) | Belongs to one category       |
| created_at  | timestamp |                               |

---

## 🛍️ Products

| Column       | Type      | Description                      |
|--------------|-----------|----------------------------------|
| id           | UUID      | Primary key                      |
| name         | string    | Product name                     |
| slug         | string    | SEO-friendly URL                 |
| description  | text      | Full description                 |
| price        | decimal   |                                 |
| stock        | integer   | Current available quantity       |
| image        | string    | Path to main product image       |
| status       | enum      | 'active', 'inactive'             |
| created_at   | timestamp |                                  |

---

## 🔗 product_sub_category (Pivot Table)

| Column         | Type      |
|----------------|-----------|
| product_id     | UUID (FK) |
| sub_category_id| UUID (FK) |

---

## 🛒 Carts

| Column     | Type      |
|------------|-----------|
| id         | UUID      |
| user_id    | UUID (FK) |
| created_at | timestamp |

---

## 🛒 cart_items

| Column     | Type      |
|------------|-----------|
| cart_id    | UUID (FK) |
| product_id | UUID (FK) |
| quantity   | integer   |

---

## 📦 Orders

| Column            | Type      | Description                  |
|-------------------|-----------|------------------------------|
| id                | UUID      | Primary key                  |
| user_id           | UUID (FK) | Customer placing the order   |
| total_price       | decimal   | Cached total for the order   |
| shipping_address  | text      | Customer delivery address    |
| status            | enum      | pending, confirmed, shipped, delivered, canceled |
| created_at        | timestamp |                              |

---

## 📦 order_items

| Column     | Type      |
|------------|-----------|
| order_id   | UUID (FK) |
| product_id | UUID (FK) |
| quantity   | integer   |
| price      | decimal   | Unit price at time of order     |

---

## 💳 Payments

| Column     | Type      |
|------------|-----------|
| id         | UUID      |
| order_id   | UUID (FK) |
| method     | enum      | cod, credit_card, paypal...     |
| amount     | decimal   |
| status     | enum      | pending, paid, failed           |
| paid_at    | timestamp |

---

## 🔚 Notes

- All primary keys are UUIDs for scalability and security.
- All timestamps are managed by Laravel's built-in `$timestamps`.
- Enum fields are used for roles and status values to ensure consistency.
