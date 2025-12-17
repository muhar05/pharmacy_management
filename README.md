# Pharmacy Management System

A comprehensive web-based pharmacy management application built with Laravel 11, designed to streamline pharmacy operations including inventory management, sales tracking, customer records, and supplier management.

## Features

- 🏥 **User Management**: Multi-role system (Admin, Pharmacist, Staff)
- 💊 **Medicine Inventory**: Complete medicine database with categories, suppliers, stock tracking, and expiry date management
- 📦 **Stock Management**: Real-time inventory tracking with low stock alerts and restock history
- 💰 **Sales Management**: Point of sale system with detailed transaction records
- 👥 **Customer Database**: Customer information and medical history tracking
- 🏢 **Supplier Management**: Supplier contact and product information
- 📊 **Reports & Analytics**: Sales reports, inventory reports, and financial summaries
- 🔐 **Secure Authentication**: Role-based access control with Laravel Breeze
- 📄 **PDF Export**: Generate reports and invoices in PDF format
- 📥 **Excel Export**: Export data to Excel for further analysis

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- **PHP**: Version 8.2 or higher
- **Composer**: Latest version
- **Node.js & NPM**: For asset compilation
- **MySQL**: Version 5.7 or higher (or MariaDB 10.3+)
- **Web Server**: Apache or Nginx
- **PHP Extensions**:
  - BCMath
  - Ctype
  - cURL
  - DOM
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PCRE
  - PDO
  - Tokenizer
  - XML
  - GD or Imagick (for PDF generation)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/muhar05/pharmacy_management.git
cd pharmacy_management
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Edit the `.env` file and configure your database settings:

```env
APP_NAME="Pharmacy Management System"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacy_management
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Database Setup

#### Option A: Using Laravel Migrations (Recommended)

```bash
# Create the database first in MySQL
mysql -u root -p -e "CREATE DATABASE pharmacy_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

#### Option B: Using SQL Files

If you prefer to use raw SQL files:

```bash
# Create database
mysql -u root -p < database/migrations/sql/create_database.sql

# Create tables
mysql -u root -p pharmacy_management < database/migrations/sql/tables.sql

# Insert sample data
mysql -u root -p pharmacy_management < database/migrations/sql/sample_data.sql

# Create indexes for performance
mysql -u root -p pharmacy_management < database/migrations/sql/indexes.sql
```

### 7. Storage Linking

Create a symbolic link for file storage:

```bash
php artisan storage:link
```

### 8. Build Frontend Assets

```bash
npm run build
```

For development with hot-reload:

```bash
npm run dev
```

### 9. Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Default Login Credentials

After seeding the database, you can login with these default credentials:

**Admin Account:**
- Email: `admin@example.com`
- Password: `admin123`

**Pharmacist Account:**
- Email: `pharmacist@example.com`
- Password: `pharmacist123`

⚠️ **Important**: Change these default passwords immediately after first login in production!

## Project Structure

```
pharmacy_management/
├── app/
│   ├── Http/
│   │   └── Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── helpers.php          # Helper functions
├── database/
│   ├── factories/           # Model factories for testing
│   ├── migrations/          # Database migrations
│   │   └── sql/            # SQL scripts (alternative setup)
│   └── seeders/            # Database seeders
├── public/                  # Public assets
├── resources/
│   ├── views/              # Blade templates
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
├── storage/                # Application storage
└── tests/                  # Application tests
```

## Database Schema

The application uses the following main tables:

- **users**: System users with role-based access
- **categories**: Medicine categories
- **suppliers**: Supplier information
- **medicines**: Medicine inventory with detailed information
- **customers**: Customer records and medical history
- **sales**: Sales transaction headers
- **sale_details**: Individual sale line items
- **restocks**: Inventory restocking history

For detailed schema information, see `database/migrations/sql/tables.sql`

## Usage Guide

### Managing Medicines

1. Navigate to **Medicines** from the dashboard
2. Click **Add Medicine** to create a new entry
3. Fill in medicine details including name, category, supplier, stock, and expiry date
4. Set minimum stock levels for automatic low-stock alerts
5. Mark if prescription is required

### Processing Sales

1. Go to **Cashier** or **Sales** section
2. Select customer (or create new)
3. Add medicines to cart
4. Process payment and generate invoice
5. Print or download receipt

### Managing Inventory

1. View current stock levels in **Medicines**
2. Check low stock alerts on dashboard
3. Record restocks in **Inventory** section
4. Monitor expiring medicines

### Generating Reports

1. Access **Reports** from the menu
2. Select report type (Sales, Inventory, etc.)
3. Set date range and filters
4. Export to PDF or Excel

## Development

### Running Tests

```bash
php artisan test
```

### Code Style

This project follows Laravel coding standards. Run PHP CS Fixer:

```bash
./vendor/bin/pint
```

### Debug Mode

For development, enable debug mode in `.env`:

```env
APP_DEBUG=true
```

**Never enable debug mode in production!**

## Maintenance

### Database Backup

Regular backups are recommended:

```bash
mysqldump -u username -p pharmacy_management > backup_$(date +%Y%m%d).sql
```

### Clearing Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Optimizing for Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

## Technologies Used

- **Backend**: Laravel 11.9 (PHP 8.2)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL 5.7+
- **Authentication**: Laravel Breeze
- **PDF Generation**: DomPDF
- **Excel Export**: Maatwebsite Excel
- **Build Tools**: Vite

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

Please ensure your code follows the project's coding standards and includes appropriate tests.

## Security

If you discover any security vulnerabilities, please email the maintainers directly instead of using the issue tracker. All security vulnerabilities will be promptly addressed.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, questions, or feature requests:
- Open an issue on GitHub
- Contact the development team
- Check the documentation

## Acknowledgments

- Built with [Laravel](https://laravel.com)
- Icons by [Heroicons](https://heroicons.com)
- UI components from [Tailwind CSS](https://tailwindcss.com)

---

**© 2025 Pharmacy Management System. All rights reserved.**
