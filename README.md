# 🛒 elbes MY - E-Commerce Platform

<p align="center">
  <strong>A modern, full-featured e-commerce platform built with Laravel 12</strong>
</p>

<p align="center">
  <a href="#features">Features</a> •
  <a href="#tech-stack">Tech Stack</a> •
  <a href="#quick-start">Quick Start</a> •
  <a href="#project-structure">Project Structure</a> •
  <a href="#api-routes">Routes</a> •
  <a href="#contributing">Contributing</a>
</p>

---

## 📖 About

**elbes MY** (Modern, Youthful, Yours) is a complete e-commerce solution for clothing retail. Built with Laravel 12 and modern frontend technologies, it offers a seamless shopping experience with features like product browsing, cart management, secure checkout, user reviews, and an admin dashboard.

---

## ✨ Features

### 🛍️ Customer Features
- **Product Catalog** - Browse clothing by category with search and filtering
- **Quick View** - Preview product details without leaving the page
- **Shopping Cart** - Add, update quantities, and remove items
- **Secure Checkout** - Complete orders with shipping details
- **Order History** - Track past purchases and order status
- **Product Reviews** - Leave reviews for purchased items
- **User Profiles** - Manage personal info, addresses, and passwords

### 🎉 Community Features
- **Event Gallery** - Browse community-submitted event images
- **Event Submissions** - Upload and share your own event photos
- **My Events** - Manage your submitted events

### 👨‍💼 Admin Features
- **Admin Dashboard** - Real-time analytics with Chart.js
- **Product Management** - CRUD operations for products
- **User Management** - Manage customer accounts and roles
- **Event Moderation** - Approve or reject event submissions
- **Order Management** - View and process customer orders

---

## 🛠️ Tech Stack

### Backend
| Technology | Version | Purpose |
|------------|---------|---------|
| **PHP** | 8.2+ | Server-side language |
| **Laravel** | 12.x | PHP framework |
| **Laravel Breeze** | 2.x | Authentication scaffolding |
| **MySQL** | 8.x | Primary database |

### Frontend
| Technology | Version | Purpose |
|------------|---------|---------|
| **Tailwind CSS** | 3.x | Utility-first CSS framework |
| **Alpine.js** | 3.x | Lightweight JS framework |
| **Vite** | 6.x | Build tool & dev server |
| **Chart.js** | - | Admin dashboard charts |

### Development Tools
| Tool | Purpose |
|------|---------|
| **PHPUnit** | Testing framework |
| **Laravel Pint** | Code style fixer |
| **PHPStan/Larastan** | Static analysis |
| **Faker** | Test data generation |

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer 2.x
- Node.js 18.x or higher
- MySQL 8.x (or SQLite for quick testing)
- XAMPP (optional, for Windows users)

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/your-username/elbes_MY.git
cd elbes_MY

# 2. Install PHP dependencies
composer install

# 3. Install Node.js dependencies
npm install

# 4. Configure environment
cp .env.example .env
php artisan key:generate

# 5. Configure your database in .env
# DB_CONNECTION=mysql
# DB_DATABASE=my_ecommerce_app
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Run migrations and seeders
php artisan migrate
php artisan db:seed

# 7. Create storage symlink
php artisan storage:link

# 8. Build assets & start development server
npm run dev          # In one terminal
php artisan serve    # In another terminal
```

Visit **http://localhost:8000** to see the application.

> 📚 For detailed setup instructions, see [SETUP.md](SETUP.md)

---

## 📁 Project Structure

```
my-ecommerce-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Request handlers
│   │   │   ├── AdminController.php
│   │   │   ├── CartController.php
│   │   │   ├── EventController.php
│   │   │   ├── ProductController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/         # HTTP middleware
│   │   └── Requests/           # Form request validation
│   ├── Models/                 # Eloquent models
│   │   ├── Cart.php
│   │   ├── Order.php
│   │   ├── Product.php
│   │   ├── Review.php
│   │   └── User.php
│   ├── Providers/              # Service providers
│   └── View/Components/        # Blade components
├── config/                     # Configuration files
├── database/
│   ├── factories/              # Model factories for testing
│   ├── migrations/             # Database schema migrations
│   └── seeders/                # Database seeders
├── public/                     # Publicly accessible files
├── resources/
│   ├── css/                    # Stylesheets
│   ├── js/                     # JavaScript files
│   └── views/                  # Blade templates
├── routes/
│   ├── web.php                 # Web routes
│   └── auth.php                # Authentication routes
├── storage/                    # App storage (logs, uploads)
└── tests/                      # PHPUnit tests
    ├── Feature/
    └── Unit/
```

---

## 🗺️ API Routes

### Public Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/` | Home page |
| GET | `/shop` | Product catalog |
| GET | `/products/{id}` | Product details |

### Authenticated Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/cart` | View shopping cart |
| POST | `/cart/add` | Add item to cart |
| GET | `/checkout` | Checkout page |
| POST | `/orders` | Place order |
| GET | `/orders/history` | Order history |
| GET | `/profile` | User profile |
| GET | `/events` | My events |
| GET | `/events/gallery` | Event gallery |
| POST | `/events` | Submit event |

### Admin Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/admin` | Admin dashboard |
| GET | `/admin/products` | Manage products |
| GET | `/admin/users` | Manage users |
| GET | `/admin/events` | Moderate events |

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

---

## 🔧 Useful Commands

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches (production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Interactive shell
php artisan tinker

# Code formatting
./vendor/bin/pint

# Static analysis
./vendor/bin/phpstan analyse
```

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Standards
- Follow PSR-12 coding standards
- Run `./vendor/bin/pint` before committing
- Write tests for new features
- Update documentation as needed

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 👥 Support

- 📧 For questions or support, contact the project maintainer
- 🐛 Report bugs via [GitHub Issues](https://github.com/your-username/elbes_MY/issues)

---

<p align="center">
  Made with ❤️ by the elbes MY Team
</p>