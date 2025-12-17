-- ============================================
-- Pharmacy Management System - Database Setup
-- ============================================
-- This script creates the main database for the pharmacy management application
-- 
-- Usage:
--   mysql -u root -p < create_database.sql
-- 
-- Author: Pharmacy Management Team
-- Created: 2025
-- ============================================

-- Drop database if exists (use with caution in production)
DROP DATABASE IF EXISTS pharmacy_management;

-- Create the database
CREATE DATABASE pharmacy_management
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Display success message
SELECT 'Database "pharmacy_management" created successfully!' AS Status;

-- Use the database
USE pharmacy_management;
