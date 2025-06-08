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

| Column          | Type        | Description                                       |
|-----------------|-------------|---------------------------------------------------|
| id              | ULID        | Primary key                                       |
| sub_category_id | ULID (FK)   | References the subcategory                        |
| name            | string      | Product name (must be unique)                     |
| slug            | string      | SEO-friendly unique URL                           |
| sku             | string      | Stock Keeping Unit (unique identifier)            |
| description     | text        | Full product description (optional)               |
| price           | decimal     | Regular price of the product                      |
| discount_price  | decimal     | Optional discounted price                         |
| stock           | integer     | Available quantity (must be ≥ 0)                  |
| status          | enum        | Product visibility: `active`, `inactive`, `draft` |
| thumbnail       | text        | product thumbnail                                 |
| created_at      | timestamp   | Creation timestamp                                |
| updated_at      | timestamp   | Last update timestamp                             |

---

## 🖼️ Product Images

| Column       | Type        | Description                                           |
|--------------|-------------|-------------------------------------------------------|
| id           | ULID        | Primary key                                           |
| product_id   | ULID (FK)   | References the related product                       |
| image_path   | string      | Path or URL to the stored image                      |
| is_primary   | boolean     | Indicates if this is the main image (default: false) |
| order        | integer     | Optional display order (default: 0)                  |
| created_at   | timestamp   | Creation timestamp                                   |
| updated_at   | timestamp   | Last update timestamp                                |

---

## ✅ Notes

- Each product can have **multiple images**, stored in the `product_images` table.
- Only one image per product should have `is_primary = true`, used as the main display image.
- `stock` is stored as an unsigned integer, and negative values are not allowed.
- `status` is used to control product visibility across the storefront and admin panel.
- All IDs are stored as **ULIDs** for better scalability and sorting performance.


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
