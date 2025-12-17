# SQL Database Setup Scripts

This directory contains SQL scripts for setting up the Pharmacy Management System database directly using MySQL/MariaDB.

## Files

1. **create_database.sql** - Creates the main database with proper character set
2. **tables.sql** - Creates all required tables with relationships
3. **sample_data.sql** - Inserts sample/seed data for testing
4. **indexes.sql** - Adds performance optimization indexes

## Quick Setup

### Complete Setup (Recommended)

Run all scripts in order:

```bash
# 1. Create database
mysql -u root -p < create_database.sql

# 2. Create tables
mysql -u root -p pharmacy_management < tables.sql

# 3. Insert sample data
mysql -u root -p pharmacy_management < sample_data.sql

# 4. Add indexes
mysql -u root -p pharmacy_management < indexes.sql
```

### Alternative: Single Command

You can also run all scripts at once:

```bash
cat create_database.sql tables.sql sample_data.sql indexes.sql | mysql -u root -p
```

## Default Credentials

After running `sample_data.sql`, you can login with:

**Temporary Credentials:**
- **Admin**: `admin@example.com` / `password`
- **Pharmacist**: `pharmacist@example.com` / `password`

⚠️ **Important**: The SQL script uses Laravel's default test password hash (`password`). To set more secure credentials:

**Option 1 - Update via Laravel Tinker:**
```bash
php artisan tinker
User::where('email', 'admin@example.com')->first()->update(['password' => Hash::make('admin123')]);
User::where('email', 'pharmacist@example.com')->first()->update(['password' => Hash::make('pharmacist123')]);
```

**Option 2 - Use Laravel Seeders Instead:**
```bash
php artisan db:seed
```
This will create users with `admin123` and `pharmacist123` passwords.

**For Production:**
1. Always change default passwords immediately
2. Use strong, unique passwords
3. Enable two-factor authentication if available

## Database Structure

The database includes these main tables:

- **users** - System users (admin, pharmacist, staff)
- **categories** - Medicine categories
- **suppliers** - Supplier information
- **medicines** - Medicine/product inventory
- **customers** - Customer records
- **sales** - Sales transactions
- **sale_details** - Sale line items
- **restocks** - Inventory restocking history
- **sessions** - User sessions
- **cache** - Application cache

## Notes

- All tables use `utf8mb4` character set for full Unicode support
- Foreign key constraints are properly defined
- Timestamps are automatically managed
- Indexes are optimized for common queries

## Laravel Alternative

If you prefer using Laravel's migration system:

```bash
php artisan migrate
php artisan db:seed
```

This is the recommended approach as it provides better version control and rollback capabilities.

## Troubleshooting

### Connection Error
If you get "Access denied" error:
```bash
mysql -u your_username -p
```
Replace `your_username` with your MySQL username.

### Database Exists
If database already exists, either:
1. Drop it first: `DROP DATABASE pharmacy_management;`
2. Or comment out the DROP/CREATE lines in `create_database.sql`

### Permission Denied
Ensure your MySQL user has privileges:
```sql
GRANT ALL PRIVILEGES ON pharmacy_management.* TO 'your_user'@'localhost';
FLUSH PRIVILEGES;
```

## Maintenance

### Backup Database
```bash
mysqldump -u root -p pharmacy_management > backup_$(date +%Y%m%d).sql
```

### Restore Database
```bash
mysql -u root -p pharmacy_management < backup_file.sql
```

### Reset Database
```bash
mysql -u root -p -e "DROP DATABASE IF EXISTS pharmacy_management;"
# Then run setup scripts again
```
