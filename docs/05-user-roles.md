# 👤 User Roles – ShopLite

This document describes the different user roles within the ShopLite system and what each role is allowed to do.

---

## 🎭 Available Roles

| Role     | Description                         |
|----------|-------------------------------------|
| Admin    | Has full access to manage the store |
| Customer | Can browse, purchase, and manage their own orders and profile |

---

## 🧑‍💼 Admin Permissions

Admins can:

- Access the admin dashboard
- Manage products (create, update, delete)
- Manage categories and subcategories
- View and update orders
- View customer profiles
- Access system statistics
- Manage payments (if implemented)

> 🔐 Protected via `auth:sanctum` middleware and `role = admin`

---

## 🛍️ Customer Permissions

Customers can:

- Register and log in
- View product listings and details
- Add items to their cart
- Place orders and make payments
- View their order history
- Manage their own profile

> 🔐 Protected via `auth:sanctum` middleware and `role = customer`

---

## 🔄 Role Assignment

- Upon registration, users are automatically assigned the `customer` role.
- Admin accounts must be created manually via database or seeder for security reasons.

---

## 🔐 Role Checking Example (Backend)

```php
// Example policy or controller check
if ($user->role->name === 'admin') {
    // Allow admin action
}
