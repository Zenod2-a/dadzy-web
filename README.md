# DAdzy Website - PHP & MySQL

A modern advertising agency website with AI-powered chatbot, built with pure PHP and MySQL.

## 📁 File Structure

```
dadzy-website/
├── index.php              # Main website (homepage)
├── .htaccess              # Apache configuration
├── config/
│   └── database.php       # Database configuration
├── api/
│   ├── chat.php           # AI Chatbot API
│   ├── contact.php        # Contact form handler
│   └── feedback.php       # Feedback form handler
├── css/
│   └── style.css          # Main stylesheet
├── js/
│   └── main.js            # JavaScript (forms, chatbox)
├── images/
│   └── favicon.svg        # Favicon
└── sql/
    └── schema.sql         # MySQL database schema
```

## 🚀 Installation

### Step 1: Upload Files

Upload all files and folders to your web server's public directory:
- `public_html/` (cPanel)
- `htdocs/` (XAMPP)
- `www/` (general)

### Step 2: Create Database Tables

1. Open **phpMyAdmin** from your hosting control panel
2. Select your existing database
3. Go to **"SQL"** tab
4. Copy and paste the contents of `sql/schema.sql`
5. Click **"Go"**

### Step 3: Configure Database

Edit `config/database.php` and update:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');     // Your database name
define('DB_USER', 'your_db_username');       // Your database username
define('DB_PASS', 'your_db_password');       // Your database password
```

### Step 4: Done!

Visit your website - everything should work!

---

## ✨ Features

### Website
- ✅ Modern black & white universe theme
- ✅ Animated cosmic background with stars
- ✅ Responsive design (mobile-friendly)
- ✅ Contact form
- ✅ Feedback form with star rating
- ✅ Team section (Founder, Co-Founder, CEO)

### AI Chatbox
- ✅ Floating chat button (bottom-right)
- ✅ Intelligent responses about services
- ✅ Quick action buttons
- ✅ Works WITHOUT database
- ✅ Works WITHOUT external AI API

---

## 📧 Contact Information

- **Email:** dadzy74@gmail.com
- **Phone:** +91 9155322282
- **Alternate:** +91 7989953154
- **Location:** Hyderabad, India

---

## 👥 Team

| Role | Name |
|------|------|
| Founder | Aaban Hoda |
| Co-Founder | Gaurav Panday |
| CEO | Munesh Singh |

---

## 🛠 Services

1. Brand Identity
2. Social Media Management
3. Paid Advertising
4. Content Marketing
5. Marketing Strategy
6. Website Design
7. Analytics & Reporting

---

## 💡 Important Notes

1. **Works without database** - Forms still submit successfully even without MySQL
2. **No external APIs** - AI chatbox runs locally
3. **No Node.js required** - Pure PHP website

---

© 2024 DAdzy. Just getting started.
