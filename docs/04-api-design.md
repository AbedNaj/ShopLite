
All routes are prefixed with `/api` and follow RESTful naming conventions.

---

## 🔓 Public Endpoints (No Auth)

| Method | Endpoint              | Description                     |
|--------|-----------------------|---------------------------------|
| GET    | /products             | List all active products        |
| GET    | /products/{id}        | Get details of a single product|
| GET    | /categories           | Get all categories              |
| GET    | /sub-categories       | Get all sub-categories          |

---

## 👤 Auth & Account (Customers)

| Method | Endpoint              | Description                   |
|--------|-----------------------|-------------------------------|
| POST   | /register             | Register new customer         |
| POST   | /login                | Login and receive token       |
| POST   | /logout               | Logout and revoke token       |
| GET    | /me                   | Get current authenticated user|

---
## 🧾 Customer Profile (Authenticated)

The following endpoints allow authenticated customers to manage their profile information.

> 🛑 Note: The customer profile is automatically created during user registration.  
There is no need for a `POST /customer` endpoint.

| Method | Endpoint              | Description                          |
|--------|-----------------------|--------------------------------------|
| GET    | /customer             | Retrieve the current user's profile  |
| PUT    | /customer/{id}        | Update the current user's profile    |
| DELETE | /customer/{id}        | Delete the current user's profile    |

---
## 🛒 Cart (Customer)

| Method | Endpoint              | Description                     |
|--------|-----------------------|---------------------------------|
| GET    | /cart                 | Get current user's cart         |
| POST   | /cart                 | Add product to cart             |
| PUT    | /cart/{item_id}       | Update quantity in cart         |
| DELETE | /cart/{item_id}       | Remove item from cart           |

---

## 📦 Orders (Customer)

| Method | Endpoint              | Description                   |
|--------|-----------------------|-------------------------------|
| POST   | /checkout             | Create new order              |
| GET    | /orders               | List current user's orders    |
| GET    | /orders/{id}          | View order details            |


---

## 💳 Payments (Optional / Future)

| Method | Endpoint              | Description                   |
|--------|-----------------------|-------------------------------|
| POST   | /payments             | Register a payment for order  |

---

## 🧑‍💼 Admin Endpoints (Auth + Role: Admin)

| Method | Endpoint              | Description                     |
|--------|-----------------------|---------------------------------|
| GET    | /admin/products       | List all products               |
| POST   | /admin/products       | Create new product              |
| GET    | /admin/products/{id}  | Show product details            |
| PUT    | /admin/products/{id}  | Update product                  |
| DELETE | /admin/products/{id} | Delete product                  |

| GET    | /admin/orders         | List all orders                 |
| PUT    | /admin/orders/{id}    | Update order status             |

| GET    | /admin/categories     | List categories                 |
| POST   | /admin/categories     | Create category                 |
| PUT    | /admin/categories/{id}| Update category                 |
| DELETE | /admin/categories/{id}| Delete category                 |

| GET    | /admin/sub-categories     | List sub-categories         |
| POST   | /admin/sub-categories     | Create sub-category         |
| PUT    | /admin/sub-categories/{id}| Update sub-category         |
| DELETE | /admin/sub-categories/{id}| Delete sub-category         |

---

## 🔐 Auth Method

- Laravel Sanctum
- Token stored in HTTP-only cookie or Authorization header

---

## 🧠 Notes

- All responses follow JSON format with status codes.
- Errors include standardized messages and codes.
- Use middleware `auth:sanctum` for protected routes.

