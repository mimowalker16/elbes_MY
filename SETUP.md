# Unique E-Commerce Platform: Setup & Local Development Guide

## Prerequisites
- **PHP**: 8.1 or newer (recommended: 8.2+)
- **Composer**: Dependency manager for PHP
- **Node.js**: 18.x or newer (for frontend assets)
- **npm**: Comes with Node.js
- **Database**: MySQL (default), SQLite supported
- **Windows**: Use PowerShell or Git Bash for commands
- **XAMPP**: (Optional) for Apache/MySQL on Windows

## 1. Clone the Repository
```powershell
git clone <your-new-repo-url> c:\xampp\htdocs\my-ecommerce-app
cd c:\xampp\htdocs\my-ecommerce-app
```

## 2. Install PHP Dependencies
```powershell
composer install
```

## 3. Install Node.js Dependencies
```powershell
npm install
```

## 4. Environment Configuration
- Copy the example environment file:
```powershell
cp .env.example .env
```
- Edit `.env` as needed:
  - Set `APP_URL` (e.g. `http://localhost`)
  - Set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` for your MySQL or SQLite setup
  - Set `FILESYSTEM_DISK=public`

## 5. Generate Application Key
```powershell
php artisan key:generate
```

## 6. Database Setup
- **Create the database** (MySQL):
    - Use phpMyAdmin or:
    ```powershell
    mysql -u root -p
    CREATE DATABASE my_ecommerce_app;
    exit
    ```
- **Run migrations in order (to avoid foreign key errors):**
    - Migration files are prefixed (a_, b_, c_) for correct order.
    ```powershell
    php artisan migrate
    ```
- **Seed unique clothing-only sample data (no duplicates):**
    ```powershell
    php artisan db:seed
    ```
    - This will create only unique, clothing-related products and categories.
    - Custom default user/admin accounts are seeded (see UserSeeder for details).

## 7. Storage Symlink (for images)
```powershell
php artisan storage:link
```

## 8. Build Frontend Assets
- For development (with hot reload):
    ```powershell
    npm run dev
    ```
- For production build:
    ```powershell
    npm run build
    ```

## 9. Run the Local Development Server
```powershell
php artisan serve
```
- Visit [http://localhost:8000](http://localhost:8000) in your browser.

## 10. (Optional) Using XAMPP/Apache
- Set DocumentRoot to `public/` directory.
- Ensure `mod_rewrite` is enabled for pretty URLs.

## 11. Running Tests
```powershell
php artisan test
```

## 12. Useful Artisan Commands
- Clear config/cache:
    ```powershell
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear
    ```
- Tinker (REPL):
    ```powershell
    php artisan tinker
    ```

## 13. Git Remote Troubleshooting & Repo Re-linking
- To disconnect from the old repository:
    ```powershell
    git remote remove origin
    ```
- To connect to a new repository:
    ```powershell
    git remote add origin <your-new-repo-url>
    git push -u origin main
    ```
- If you want a fresh commit history, delete the `.git` folder and reinitialize:
    ```powershell
    rmdir /s /q .git
    git init
    git remote add origin <your-new-repo-url>
    git add .
    git commit -m "Initial commit"
    git push -u origin main
    ```

## 14. Troubleshooting
- **Image upload issues:** Ensure `storage/` and `storage/app/public/` are writable. Run `php artisan storage:link`.
- **.env not loaded:** Double-check file name and permissions.
- **Database errors:** Confirm DB credentials and that the DB exists.
- **Node/npm errors:** Delete `node_modules` and run `npm install` again.
- **Migration errors:** Ensure you run migrations in the correct order (see above).

---

For further details, see the README or contact the project maintainer.
