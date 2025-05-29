# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Learn Danish Swiftly (LDS) - A Laravel 12 application with Vue.js components for interactivity, styled with Tailwind CSS. Uses traditional server-side rendering with Blade templates, enhanced with Vue components where needed.

### Features
- User authentication with approval system
- Word upload functionality for approved users
- Mini-games for learning Danish:
  - Matching Pairs Game (Memory card game with Danish-English word pairs)
  - Multiple Choice Quiz (planned)
  - Word Builder (planned)
  - Sentence Constructor (planned)

## Essential Commands

### Development
- `npm run dev` - Start Vite development server (hot module replacement)
- `composer dev` - Run all development services concurrently (Laravel server, queue, logs, Vite)
- `php artisan serve` - Run Laravel development server only

### Testing
- `php artisan test` - Run all tests
- `php artisan test --filter TestName` - Run specific test
- `composer test` - Clear config cache and run tests

### Build
- `npm run build` - Build production assets with Vite

### Database
- `php artisan migrate` - Run database migrations
- `php artisan migrate:fresh --seed` - Reset database with seeds
- `php artisan tinker` - Interactive PHP REPL with Laravel context

## Architecture

### Stack
- **Backend**: Laravel 12.16.0 (PHP 8.2+)
- **Frontend**: Vue 3.5.16 components, Alpine.js 3.4.2, Tailwind CSS 3.1.0
- **Auth**: Laravel Breeze (traditional Blade templates)
- **Database**: SQLite (file: database/database.sqlite)
- **Asset Bundler**: Vite

### Key Patterns
- Traditional MVC with server-side rendering
- Vue components for interactive features (not SPA)
- Form Request classes for validation
- Blade component architecture for reusable UI elements
- Tailwind utility-first CSS approach

### Directory Structure Notes
- Vue components: `resources/js/components/`
  - `MatchingPairsGame.vue` - Memory card game component
- Blade views: `resources/views/`
  - `games/` - Game-related views
- Controllers: `app/Http/Controllers/`
  - `GameController.php` - Handles game routes
  - `Auth/` - Authentication controllers
- Test files mirror app structure in `tests/`

## Development Environment

Local development uses Laravel Valet (per planning docs). The application URL is configured in `.env` file.

## Testing Approach

- Feature tests for HTTP endpoints and user flows
- Unit tests for isolated business logic
- SQLite in-memory database for test speed
- Test database transactions rolled back after each test