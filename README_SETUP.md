# User Management System Setup Guide

## 🚀 Complete Login System Implementation

This is a complete user management system with registration, login, and dashboard functionality.

## 📋 Setup Instructions

### 1. Database Setup

1. Open phpMyAdmin or MySQL command line
2. Run the SQL commands from `database_setup.sql`
3. Or manually create the database and table:
   ```sql
   CREATE DATABASE useraccounts;
   USE useraccounts;
   -- Then run the CREATE TABLE command from database_setup.sql
   ```

### 2. File Structure

```
Test_Website/
├── assets/
│   └── css/
│       └── style.css          # External CSS styles
├── config.php                 # Database configuration
├── index.php                  # Dashboard (requires login)
├── login.php                  # Login page
├── login_process.php          # Login processing
├── registration.php           # Registration page
├── process_new.php            # Registration processing
├── logout.php                 # Logout functionality
├── database_setup.sql         # Database setup script
└── README_SETUP.md            # This file
```

### 3. How It Works

#### Registration Flow:

1. User fills registration form
2. Data is validated (email format, required fields)
3. Email uniqueness is checked
4. Password is hashed using bcrypt
5. User is stored in database
6. Success message is shown

#### Login Flow:

1. User enters email and password
2. Credentials are validated
3. Password is verified against hash
4. Session is created
5. User is redirected to dashboard

#### Dashboard:

1. Session is checked on page load
2. User info is displayed
3. Welcome message with user details
4. Logout functionality

### 4. Security Features

✅ **Password Hashing**: Uses bcrypt (PASSWORD_DEFAULT)
✅ **Session Management**: Proper session handling
✅ **Input Validation**: Server-side validation
✅ **SQL Injection Prevention**: Prepared statements
✅ **XSS Protection**: htmlspecialchars() for output
✅ **CSRF Protection**: Form-based submissions
✅ **Email Uniqueness**: Prevents duplicate accounts

### 5. Features

🎨 **Modern UI**: Glass-morphism design with gradients
📱 **Responsive**: Works on all devices
🔐 **Secure**: Industry-standard security practices
✨ **Interactive**: SweetAlert notifications
🎯 **User-Friendly**: Clear messages and navigation

### 6. Testing

1. **Registration Test**:

   - Go to `registration.php`
   - Fill all fields
   - Submit form
   - Check for success message

2. **Login Test**:

   - Go to `login.php`
   - Enter registered email/password
   - Check redirect to dashboard

3. **Session Test**:
   - Try accessing `index.php` without login
   - Should redirect to login page

### 7. Customization

- **Styles**: Edit `assets/css/style.css`
- **Database**: Modify `config.php`
- **Messages**: Update SweetAlert messages in JS
- **Redirects**: Change redirect URLs in PHP files

### 8. Database Schema

```sql
users table:
- id (Primary Key, Auto Increment)
- firstname (VARCHAR 50)
- lastname (VARCHAR 50)
- email (VARCHAR 100, UNIQUE)
- phonenumber (VARCHAR 20)
- password (VARCHAR 255, hashed)
- created_at (TIMESTAMP)
- last_login (TIMESTAMP)
- is_active (TINYINT 1)
```

## 🎯 Ready to Use!

Your complete user management system is now ready. All files are properly connected and secured!
