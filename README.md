## Blog Microsystem
A simple blog system built with Laravel, featuring an API and an admin dashboard.
Users can create posts, verify payment before publishing, and dashboard users have role-based access control.


## 🚀 Features

### API for Posts

List published and paid posts.

Create posts (requires payment).

Update and delete posts.

Clean and consistent API responses.

### Admin Dashboard

Post management with filters by status and author.

View whether posts are paid.

Role-based access:

Admin: full access.

Editor: can create/edit own posts, cannot delete.

Custom action: mark post as paid manually.

## Payment Integration

Stripe integration for post payments.

Only paid posts can be published.

## Multi-language Support

Translate post titles and content.

Easy to extend with additional languages.

## 🛠️ Requirements

PHP 8.1+

Laravel 12+

MySQL or PostgreSQL

Composer

Node.js & npm

Stripe API for payments

## ⚙️ Installation

Clone the repository

git clone https://github.com/m77mdabdo/Blog_Microsystem.git
cd Blog_Microsystem

## Install PHP dependencies
composer install

## Install Node dependencies
npm install
npm run dev

## 🔐 Roles & Permissions
Admin
Full access (view, create, edit, delete, mark paid)

Editor
Create/edit own posts, cannot delete

## 🌐 Multi-language Support
Translation files are located in resources/lang/.

To add a new language:

Create a folder with the language code (e.g., ar for Arabic).

Add translation files with keys and values.

## 💳 Payment Flow 
User creates a post via the API.

Redirected to Stripe Checkout.

Upon successful payment, the post is marked as paid.

Only paid posts are displayed in published lists.

Admins can manually mark posts as paid in the dashboard. 
