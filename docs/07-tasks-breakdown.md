# ✅ Tasks Breakdown – ShopLite

This file outlines the full task breakdown for building the ShopLite e-commerce platform using a UI-first approach, then connecting each feature to the backend API progressively.

---

## 🎨 Phase 1 – UI Design (Static Frontend)

> Goal: Design all pages using Vue 3 + Tailwind CSS, using dummy data only.

### Public UI
- [ ] Home Page layout
- [ ] Product Card component
- [ ] Product Listing Page (with sidebar filter)
- [ ] Single Product Page (details + image preview)

### Auth UI
- [ ] Login Page (static)
- [ ] Register Page (static)
- [ ] Password Reset Page (optional)

### Admin UI
- [ ] Admin Layout (Sidebar + Header)
- [ ] Admin Dashboard Page (empty)
- [ ] Category Management UI (static CRUD table)

---

## 🧱 Phase 2 – Backend Development (Laravel 12)

> Goal: Build API endpoints to match UI needs, one feature at a time.

### Auth & Roles
- [ ] Setup Laravel Sanctum
- [ ] Register, Login, Logout APIs
- [ ] Create `roles` table and assign roles
- [ ] Middleware for `role = admin`

### Categories API
- [ ] Create `categories` table + model + controller
- [ ] REST API: index, store, update, delete
- [ ] Resource classes for consistent JSON

---

## 🔌 Phase 3 – API Integration (Vue + Axios)

> Goal: Connect Vue components to backend API, feature by feature.

### Auth
- [ ] Connect login/register forms to API
- [ ] Store user and token in state (Pinia or localStorage)
- [ ] Use auth headers with Axios
- [ ] Protect routes by role

### Categories
- [ ] Fetch and display categories in Admin UI
- [ ] Connect category create form
- [ ] Connect edit/delete actions
- [ ] Handle API errors and show feedback

---

## 📦 Phase 4 – Products & Orders (Continue as Needed)

- [ ] Design product management UI
- [ ] Implement product CRUD API
- [ ] Integrate product endpoints with UI

- [ ] Design cart and checkout pages
- [ ] Create cart and order API
- [ ] Integrate full order flow

---

## 🧪 Phase 5 – Optional Enhancements

- [ ] Multilingual support (English + Arabic)
- [ ] Responsive adjustments
- [ ] Dashboard stats (orders, sales, etc.)
- [ ] Product reviews
- [ ] File/image upload with preview
- [ ] Confirmation modals and toast messages
- [ ] Payment integration (Stripe, etc.)

