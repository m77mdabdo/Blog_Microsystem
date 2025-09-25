## Blog Microsystem
A simple blog system built with Laravel, featuring an API and an admin dashboard.
Users can create posts, verify payment before publishing, and dashboard users have role-based access control.


## 🏗️ Features

### API
- List posts → only published and paid posts are shown.
- Create posts → requires payment before storing.
- Update posts.
- Delete posts.
- Payment is verified before marking a post as paid.
- Clean and consistent JSON API responses.

### Admin Dashboard
- Post management with multi-language support.
- Forms include: title (multi-language), content, and status.
- Post table includes filters by status and author.
- Shows whether a post is paid.
- Role-based restrictions:
  - **Admin**: full access (view, create, edit, delete, mark as paid)
  - **Editor**: create and edit own posts only, cannot delete.
- Custom admin action to manually mark a post as paid.

### Roles & Permissions
- **Admin**: full access.
- **Editor**: limited access (create/edit own posts).
- Permissions stored and enforced in the system.

### Payment Integration
- Supports payment flow before storing posts.
- Users redirected to a payment provider (Stripe) when creating a post.
- Posts are marked as paid only after successful payment.

### Multi-language Support
- Title supports multiple languages.
- Translation mechanism implemented for easy expansion.

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



.

. 
