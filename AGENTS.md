# AGENTS.md

## Overview
This is a Laravel 13.x PHP web application using Vite and TailwindCSS for frontend assets.

## Setup
Use the `composer setup` script for full environment setup with correct order:

```bash
composer run-script setup
```

This runs:
- `composer install` (PHP dependencies)
- Copies `.env.example` to `.env` if missing
- `php artisan key:generate` (app key setup)
- `php artisan migrate --force` (database schema)
- `npm install --ignore-scripts` (JS dependencies)
- `npm run build` (frontend assets build)


## Development
Start the full dev environment with:

```bash
composer run dev
```

Which runs concurrently:
- `php artisan serve` (PHP local server)
- `php artisan queue:listen --tries=1 --timeout=0` (queues)
- `php artisan pail --timeout=0` (static analysis tool)
- `npm run dev` (Vite dev server with hot reload)


## Testing
Run tests with:

```bash
composer run test
```

This clears config cache and runs `php artisan test`.

PHPUnit config uses an in-memory SQLite DB with environment overrides for testing.

## Environment
- `.env.example` provides baseline environment vars.
- App expects typical Laravel DB, cache, queue, and mail setups via env vars.
- Session driver is `database` in `.env.example`.

## Project structure
- Application code under `app/`.
- HTTP routes defined in `routes/web.php` and `routes/console.php`.
- Blade view templates under `resources/views/`.
- Frontend assets in `resources/js/` and `resources/css/`.
- Tests under `tests/` with Unit and Feature subfolders.

## Laravel Boost
Though not mandatory, installing [Laravel Boost](https://laravel.com/docs/ai) with:

```bash
composer require laravel/boost --dev
php artisan boost:install
```

greatly improves agent accuracy by providing AI tools and skills tailored for Laravel projects.

## Tips
- Always run migrations before tests or dev server.
- Use the provided composer scripts rather than guessing separate commands.
- `npm run build` is needed after JS dependency installs in setup.
- Environment variable setup is critical; check `.env` is created and configured.
- Watch for asset caching when debugging frontend styles/scripts.

## Summary
This project adheres closely to Laravel conventions but requires strict adherence to setup and dev scripts outlined here for smooth agent operation.

---

This file is a living document to avoid common pitfalls and improve AI agent ramp-up speed in this Laravel repository.
