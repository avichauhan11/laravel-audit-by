# Laravel Audit By

A lightweight Laravel package to automatically manage  
`created_by`, `updated_by`, and `deleted_by` fields on Eloquent models.

Designed to work with **Auth**, **session-based logins**, or **mixed systems**  
(admin panels, APIs, legacy apps).

---

## Features

- Automatically sets:
    - `created_by` on create
    - `updated_by` on update
    - `deleted_by` on soft delete
- Supports:
    - Laravel Auth (multiple guards)
    - Session-based users (custom keys)
    - Fallback chains (Auth → Session)
- Laravel 10, 11, and 12 compatible
- Zero observers
- Zero boilerplate
- Opt-in per model

---

## Requirements

- PHP 8.1+
- Laravel 10 / 11 / 12

---

## Installation

Install via Composer:

```bash
composer require avie/laravel-audit-by
