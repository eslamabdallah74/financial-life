<div align="center">

# 💰 Finance Tracker

### Master Your Financial Life

A modern, beautiful finance tracking application built with Laravel and Tailwind CSS. Track expenses, manage budgets, and gain insights into your spending habits with an intuitive, premium interface.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![SQLite](https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white)](https://www.sqlite.org)

[Features](#-features) • [Screenshots](#-screenshots) • [Installation](#-installation) • [Usage](#-usage) • [Tech Stack](#-tech-stack)

</div>

---

## ✨ Features

### 🎯 Core Functionality
- **📊 Smart Dashboard** - Real-time financial overview with interactive statistics
- **💸 Transaction Management** - Beautiful, intuitive forms for tracking income and expenses
- **🏷️ Custom Categories** - Organize transactions with colorful, icon-based categories
- **📈 Balance Tracking** - Live balance calculation with privacy toggle
- **🔒 Secure Authentication** - Built on Laravel Breeze with email verification

### 🎨 Premium UI/UX
- **🌓 Dark Theme Landing Page** - Stunning gradient hero with animated elements
- **✨ Glassmorphism Effects** - Modern translucent cards and navigation
- **🎭 Smooth Animations** - Micro-interactions and hover effects throughout
- **📱 Fully Responsive** - Optimized for mobile, tablet, and desktop
- **♿ Accessible** - Keyboard navigation and ARIA labels

### 🚀 Advanced Features
- **👁️ Balance Privacy Toggle** - Hide/show your balance with blur effect
- **🔍 Category Search** - Quick filter for finding categories
- **📅 Date Management** - Calendar picker with default to today
- **💾 Real-time Calculations** - Instant balance and statistics updates
- **🎯 Quick Actions** - Sidebar shortcuts for common tasks

---

## 📸 Screenshots

<div align="center">

### Landing Page
![Landing Page](https://via.placeholder.com/800x400/667eea/ffffff?text=Modern+Dark+Theme+Landing)

### Dashboard
![Dashboard](https://via.placeholder.com/800x400/764ba2/ffffff?text=Interactive+Statistics+Dashboard)

### Transactions
![Transactions](https://via.placeholder.com/800x400/f093fb/ffffff?text=Beautiful+Transaction+Cards)

### Add Transaction
![Add Transaction](https://via.placeholder.com/800x400/4facfe/ffffff?text=Premium+Form+Design)

</div>

---

## 🛠️ Tech Stack

| Category | Technology |
|----------|-----------|
| **Backend** | Laravel 11.x |
| **Frontend** | Blade Templates, Alpine.js, Tailwind CSS |
| **Database** | SQLite (easily switchable to MySQL/PostgreSQL) |
| **Authentication** | Laravel Breeze |
| **Build Tool** | Vite |
| **Icons** | Heroicons |

---

## 🚀 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 20.19+ and npm
- SQLite extension enabled

### Step 1: Clone the Repository
```bash
git clone https://github.com/eslamabdallah74/financial-life.git
cd finance-tracker
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup
```bash
# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# (Optional) Seed with sample data
php artisan db:seed
```

### Step 5: Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### Step 6: Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser! 🎉

---

## 📖 Usage

### Creating Your First Transaction

1. **Register an Account** - Click "Get Started" on the landing page
2. **Navigate to Transactions** - Use the sidebar navigation
3. **Click "Add Transaction"** - Premium modal form opens
4. **Fill in Details**:
   - Select Income or Expense
   - Enter amount (auto-formats to 2 decimals)
   - Choose a category (or create new one)
   - Add optional description
   - Set date
5. **Submit** - Transaction appears instantly in your list!

### Managing Categories

Categories help organize your transactions:
- Go to **Categories** in sidebar
- Click **"New Category"**
- Choose icon, color, name, and type
- Use across all transactions

### Dashboard Insights

Your dashboard shows:
- **Total Balance** - All-time income minus expenses
- **Monthly Income** - Current month's earnings
- **Monthly Expenses** - Current month's spending
- **Savings Rate** - Percentage of income saved
- **Recent Transactions** - Last 5 transactions

---

## 🎨 Design System

### Color Palette
```css
Primary Gradient: #667eea → #764ba2
Success: #10b981
Danger: #ef4444
Info: #3b82f6
Warning: #f59e0b
```

### Key Components
- **Glass Cards** - `rgba(15, 23, 42, 0.6)` with backdrop blur
- **Gradient Buttons** - Smooth indigo to purple transitions
- **Hover Effects** - Subtle scale and shadow animations
- **Typography** - Inter font family throughout

---

## 🔐 Security Features

- ✅ CSRF Protection on all forms
- ✅ Password hashing with bcrypt
- ✅ Email verification required
- ✅ SQL injection prevention via Eloquent ORM
- ✅ XSS protection with Blade escaping

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🙏 Acknowledgments

- **Laravel** - The PHP framework for web artisans
- **Tailwind CSS** - A utility-first CSS framework
- **Heroicons** - Beautiful hand-crafted SVG icons
- **Alpine.js** - Lightweight JavaScript framework

---

## 📧 Contact

**Eslam Abdallah** - [@eslamabdallah74](https://github.com/eslamabdallah74)

Project Link: [https://github.com/eslamabdallah74/financial-life](https://github.com/eslamabdallah74/financial-life)

---

<div align="center">

### ⭐ Star this repository if you find it helpful!

Made with ❤️ using Laravel and Tailwind CSS

</div>
