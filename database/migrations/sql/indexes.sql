-- ============================================
-- Pharmacy Management System - Database Indexes
-- ============================================
-- This script creates indexes for performance optimization
--
-- Index Strategy:
--   - Primary keys are automatically indexed
--   - Foreign keys are indexed for JOIN operations
--   - Commonly queried fields are indexed
--   - Composite indexes for multi-column queries
--
-- Usage:
--   USE pharmacy_management;
--   source indexes.sql;
--   -- OR --
--   mysql -u root -p pharmacy_management < indexes.sql
-- ============================================

USE pharmacy_management;

-- ============================================
-- Users Table Indexes
-- ============================================
-- Email is already UNIQUE (automatically indexed)
-- Add index for position lookups (filtering by role)
CREATE INDEX IF NOT EXISTS idx_users_position ON users(position);

-- ============================================
-- Medicines Table Indexes
-- ============================================
-- Foreign keys are already indexed by default in InnoDB
-- Add index for common search patterns

-- Index for searching medicines by name
CREATE INDEX IF NOT EXISTS idx_medicines_name ON medicines(name);

-- Index for filtering by stock level (low stock alerts)
CREATE INDEX IF NOT EXISTS idx_medicines_stock ON medicines(stock);

-- Index for expiry date queries (checking expired medicines)
CREATE INDEX IF NOT EXISTS idx_medicines_expiry_date ON medicines(expiry_date);

-- Composite index for category and stock (category-wise stock reports)
CREATE INDEX IF NOT EXISTS idx_medicines_category_stock ON medicines(category_id, stock);

-- Index for prescription requirement filtering
CREATE INDEX IF NOT EXISTS idx_medicines_prescription ON medicines(require_prescription);

-- ============================================
-- Sales Table Indexes
-- ============================================
-- Foreign keys (customer_id, user_id) are already indexed

-- Index for date-based queries (daily/monthly sales reports)
CREATE INDEX IF NOT EXISTS idx_sales_date ON sales(sale_date);

-- Index for payment status filtering
CREATE INDEX IF NOT EXISTS idx_sales_payment_status ON sales(payment_status);

-- Composite index for date range and user (staff performance reports)
CREATE INDEX IF NOT EXISTS idx_sales_date_user ON sales(sale_date, user_id);

-- Composite index for date and payment status (outstanding payments)
CREATE INDEX IF NOT EXISTS idx_sales_date_payment ON sales(sale_date, payment_status);

-- ============================================
-- Sale Details Table Indexes
-- ============================================
-- Foreign keys (sale_id, medicine_id) are already indexed

-- Note: For accurate medicine sales analysis by date, join with sales table and use sale_date
-- This index on created_at is for record creation tracking purposes

-- ============================================
-- Customers Table Indexes
-- ============================================
-- Index for customer name searches
CREATE INDEX IF NOT EXISTS idx_customers_name ON customers(name);

-- Index for phone number lookups
CREATE INDEX IF NOT EXISTS idx_customers_phone ON customers(phone);

-- ============================================
-- Restocks Table Indexes
-- ============================================
-- Foreign key (medicine_id) is already indexed

-- Index for date-based restock history
CREATE INDEX IF NOT EXISTS idx_restocks_date ON restocks(restock_date);

-- Composite index for medicine restock history
CREATE INDEX IF NOT EXISTS idx_restocks_medicine_date ON restocks(medicine_id, restock_date);

-- ============================================
-- Suppliers Table Indexes
-- ============================================
-- Index for supplier name searches
CREATE INDEX IF NOT EXISTS idx_suppliers_name ON suppliers(name);

-- ============================================
-- Categories Table Indexes
-- ============================================
-- Index for category name searches
CREATE INDEX IF NOT EXISTS idx_categories_name ON categories(name);

-- ============================================
-- Sessions Table Indexes
-- ============================================
-- user_id and last_activity indexes are already created in table creation

-- ============================================
-- Cache Table Indexes
-- ============================================
-- Key is already PRIMARY (automatically indexed)
-- Add index for expiration cleanup queries
CREATE INDEX IF NOT EXISTS idx_cache_expiration ON cache(expiration);

-- ============================================
-- Display Success Message
-- ============================================
SELECT 'All indexes created successfully!' AS Status;

-- ============================================
-- Show Index Information
-- ============================================
SELECT 'Displaying index information for key tables...' AS '';

-- Show indexes on medicines table
SELECT '--- Medicines Table Indexes ---' AS '';
SHOW INDEX FROM medicines;

-- Show indexes on sales table
SELECT '--- Sales Table Indexes ---' AS '';
SHOW INDEX FROM sales;

-- Show indexes on customers table
SELECT '--- Customers Table Indexes ---' AS '';
SHOW INDEX FROM customers;

-- ============================================
-- Performance Tips
-- ============================================
SELECT '============================================' AS '';
SELECT 'Performance Optimization Tips:' AS '';
SELECT '1. Regularly run ANALYZE TABLE to update statistics' AS '';
SELECT '2. Monitor slow query log for optimization opportunities' AS '';
SELECT '3. Consider partitioning for large tables (sales, sale_details)' AS '';
SELECT '4. Regular maintenance: OPTIMIZE TABLE monthly' AS '';
SELECT '============================================' AS '';
