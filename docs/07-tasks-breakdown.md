## ✅ Tasks Breakdown – ShopLite

> A structured breakdown for building the ShopLite e-commerce platform using Laravel 12 and Vue 3 (SPA).  
> Backend-first approach: APIs first, then frontend integration.

---

### ⚙️ Phase 1 – Admin API Development (Laravel 12)

> Goal: Implement all backend functionality for admin panel with testing and role-based authorization.

#### Auth & Roles
- [x] Setup Laravel Sanctum
- [x] Create roles table (admin, customer)
- [x] Assign roles to users
- [x] Admin-only middleware
- [x] Admin login/logout API
- [ ] Protect routes using policies

#### Categories
- [x] Categories table + model + controller
- [x] API: index, store, update, delete, show
- [x] Image upload (DigitalOcean Spaces)
- [x] Authorization using Policy
- [x] Feature tests for admin & customer

#### SubCategories
- [x] SubCategories table + model + controller
- [x] API: index, store, update, delete, show
- [x] Image upload (DigitalOcean Spaces)
- [x] Authorization using Policy
- [x] Feature tests for admin & customer


#### Products
- [x] Products table + model + controller
- [x] CRUD API with image support
- [x] Categories relation
- [x] Inventory and status fields
- [x] Authorization + tests

#### Orders & Customers
- [ ] Orders table + model + controller
- [ ] API to manage and view orders
- [ ] Filter by status/date
- [ ] Order details with customer info
- [ ] Customer management API

---

### 🖥️ Phase 2 – Vue Admin Panel (SPA)

> Goal: Build full admin UI using Vue 3 + Tailwind + Vue Router + Axios

#### Layout
- [ ] Admin layout with sidebar + header
- [ ] Protected routes (admin only)
- [ ] Basic auth state management (Pinia/localStorage)

#### Dashboard
- [ ] Display basic stats (orders count, revenue)
- [ ] Recent activity or orders preview

#### Categories
- [ ] List categories in a table
- [ ] Add/Edit/Delete category modals or pages
- [ ] Show image previews and upload
- [ ] Connect to API with Axios

#### Products
- [ ] Product management table
- [ ] Add/Edit/Delete product
- [ ] Category filter
- [ ] Image handling
- [ ] Connect to API

#### Orders
- [ ] Order listing page
- [ ] View order details
- [ ] Update status (pending, shipped, etc.)

---

### 🌐 Phase 3 – Public API Development

> Goal: Create all public-facing API endpoints for the storefront

#### Auth
- [ ] Customer register/login/logout APIs

#### Products
- [ ] List all products
- [ ] Filter by category, search
- [ ] Single product details

#### Cart & Checkout
- [ ] Cart management (session or token-based)
- [ ] Place order API
- [ ] Order history (for customers)

---

### 🎨 Phase 4 – Public Website (Vue)

> Goal: Build the main store pages (SPA) and integrate public APIs

#### UI
- [ ] Home Page
- [ ] Product listing with filters
- [ ] Single product page
- [ ] Register/Login
- [ ] Cart Page
- [ ] Checkout Page
- [ ] Order history for customer

#### Integration
- [ ] Connect to product APIs
- [ ] Handle auth flow for customer
- [ ] Cart and order functionality
- [ ] Handle errors and validation feedback

---

### 🧪 Optional: Testing & Enhancements

- [ ] Continue feature testing
- [ ] Add more policies
- [ ] Multilingual support (EN/AR)
- [ ] Responsive UI
- [ ] Toast notifications
- [ ] Stripe/Payment integration
- [ ] Review & rating system