-- ============================================
-- DAdzy Website Database Schema
-- MySQL Database Tables
-- 
-- HOW TO USE:
-- 1. Open phpMyAdmin
-- 2. Select your database
-- 3. Go to "SQL" tab
-- 4. Copy and paste this entire file
-- 5. Click "Go"
-- ============================================

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    company VARCHAR(100),
    budget VARCHAR(50),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'read', 'replied') DEFAULT 'new'
);

-- Feedback Table
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(255),
    company VARCHAR(100),
    rating INT DEFAULT 0,
    feedback TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Chat Messages Table
CREATE TABLE IF NOT EXISTS chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    is_bot BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Services Table
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Team Table
CREATE TABLE IF NOT EXISTS team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100) NOT NULL,
    email VARCHAR(255),
    bio TEXT,
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Insert Default Services
INSERT INTO services (title, description, icon, display_order) VALUES
('Brand Identity', 'Logo design, color palettes, typography, and brand guidelines that define who you are.', 'palette', 1),
('Social Media Management', 'Content creation, posting, and engagement to build your community on social platforms.', 'share-nodes', 2),
('Paid Advertising', 'Strategic ad campaigns on Google, Facebook, Instagram, and more to reach new customers.', 'bullhorn', 3),
('Content Marketing', 'Blog posts, articles, newsletters, and storytelling that connects with your audience.', 'pen-nib', 4),
('Marketing Strategy', 'Comprehensive marketing plans tailored to your goals, audience, and budget.', 'crosshairs', 5),
('Website Design', 'Modern, responsive websites that showcase your brand and convert visitors.', 'globe', 6),
('Analytics & Reporting', 'Track performance, understand your audience, and optimize for better results.', 'chart-bar', 7)
ON DUPLICATE KEY UPDATE title=VALUES(title);

-- Insert Team Members
INSERT INTO team (name, role, email, display_order) VALUES
('Aaban Hoda', 'Founder', 'aaban@dadzy.com', 1),
('Gaurav Panday', 'Co-Founder', 'gaurav@dadzy.com', 2),
('Munesh Singh', 'CEO', 'munesh@dadzy.com', 3)
ON DUPLICATE KEY UPDATE name=VALUES(name);
