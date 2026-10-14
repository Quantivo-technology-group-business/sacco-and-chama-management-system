# SACCO and Chama Management System

A comprehensive, enterprise-grade financial management platform tailored for SACCOs (Savings and Credit Cooperative Organizations), Microfinance Institutions, and Chamas (Investment & Merry-Go-Round groups).

---

## 🌟 Core Modules & Capabilities

- **Chama & Merry-Go-Round**: Rotational payout schedules, contribution tracking, member portal integration, and automated cycle settlements.
- **Loan Management**: Multi-product loan origination, schedule generation, approval pipelines, amortization, interest calculations, penalty handling, and restructuring.
- **Client & Member Directory**: Complete KYC onboarding, next-of-kin records, document attachments, and branch assignment.
- **Savings & Shares**: Flexible savings products, fixed deposits, share capital tracking, dividend allocation, and statement generation.
- **Double-Entry Accounting**: Full chart of accounts, automated journal entries, trial balance, ledger reporting, and profit & loss statements.
- **Payment Gateway Integrations**: Built-in support for **M-Pesa (STK Push & C2B/B2C)**, Flutterwave, PayPal, Stripe, and Paynow.
- **Branch & Staff Management**: Multi-branch support, role-based access control (RBAC), and full audit/activity logging.
- **Payroll & Expenses**: Staff salary structures, payslips, recurring organizational expenses, and budget tracking.
- **Member Portal**: Self-service member dashboard to view loan balances, repayment schedules, Chama cycles, and savings.

---

## 🏗️ Architecture & Tech Stack

- **Backend Framework**: Laravel 8 / PHP ^7.4 || ^8.0
- **Modular Structure**: Laravel Modules (`nwidart/laravel-modules`)
- **Frontend / UI**: AdminLTE 3 / Bootstrap 4, Livewire, DataTables
- **Database**: MySQL / MariaDB (Schema included in `ulm.sql`)
- **Authentication**: Laravel Passport (API OAuth2) & Session-based Web Auth

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 7.4 or 8.0
- Composer >= 2.0
- MySQL >= 5.7 or MariaDB >= 10.3
- Node.js & NPM (for frontend asset compilation)

### Installation Steps

1. **Clone the repository:**
   ```bash
   git clone git@github.com:Quantivo-technology-group-business/sacco-and-chama-management-system.git
   cd sacco-and-chama-management-system
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update `.env` with your database credentials and gateway configurations (M-Pesa, Flutterwave, etc.).

4. **Database Setup:**
   Import `ulm.sql` into your database or run migrations:
   ```bash
   php artisan migrate --seed
   ```

5. **Generate Passport Keys & Storage Link:**
   ```bash
   php artisan passport:install
   php artisan storage:link
   ```

6. **Compile Assets & Serve:**
   ```bash
   npm install && npm run dev
   php artisan serve
   ```

Default administrator credentials:
- **Email**: `admin@webstudio.co.zw`
- **Password**: `admin123`

---

## 📖 Documentation
Detailed documentation is included in the `documentation/` directory and can also be accessed via the built-in documentation module at `/docs` when the application is running.

---

## 🏢 Organization
Maintained under [Quantivo Technology Group Business](https://github.com/Quantivo-technology-group-business).
