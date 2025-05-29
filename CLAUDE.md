# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Swift Danish (formerly Learn Danish Swiftly/LDS) - An interactive language learning platform built with Laravel 12 and Vue.js. The application helps users learn Danish through engaging mini-games and personalized vocabulary practice.

### Core Features

#### 🎮 Interactive Mini-Games
1. **Matching Pairs** - Classic memory card game where players match Danish words with English translations
2. **Match Madness** - Fast-paced timed game (60 seconds) where players race to match word pairs
   - Features delayed replacement system (2-4 seconds)
   - Random placement of new pairs in empty slots
   - Progressive difficulty with 30 total word pairs
3. **Word Builder** (planned) - Construct Danish words from letter components
4. **Sentence Constructor** (planned) - Build grammatically correct Danish sentences

#### 👤 User Management
- Laravel Breeze authentication with custom approval workflow
- User registration requires admin approval before access
- Super admin role for user management
- Personalized word upload functionality for approved users

#### 🎨 Design & Branding
- Custom Swift Danish logo and branding
- Responsive design optimized for mobile and desktop
- Tailwind CSS for modern, clean UI
- Smooth animations and transitions in games

### Technical Highlights
- Traditional server-side rendering with Blade templates
- Vue 3 components for interactive game elements
- SCSS support for component styling
- SQLite database for simple deployment
- Vite for fast development and optimized builds

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
  - `MatchMadnessGame.vue` - Fast-paced matching game with timer
  - `MatchMadnessGame.scss` - Styles for Match Madness game
- Blade views: `resources/views/`
  - `games/` - Game-related views
  - `admin/users/` - Admin user management views
  - `approval/` - User approval pending views
- Controllers: `app/Http/Controllers/`
  - `GameController.php` - Handles game routes
  - `Admin/UserApprovalController.php` - Admin user approval
  - `Auth/` - Authentication controllers
- Middleware: `app/Http/Middleware/`
  - `EnsureUserIsApproved.php` - Blocks unapproved users
  - `EnsureUserIsSuperAdmin.php` - Protects admin routes
- Test files mirror app structure in `tests/`

## Development Environment

Local development uses Laravel Valet. The application runs at `https://lds.test`.

### Important: Browser Testing
**Always use the browsermcp tool to test changes in the browser at https://lds.test**. This ensures that:
- Vue components are properly loaded and rendered
- JavaScript interactions work correctly
- Visual layout and styling are as expected
- Game mechanics function properly
- User flows work end-to-end

Example browser testing workflow:
```
1. Make code changes
2. Use browsermcp tool to navigate to https://lds.test
3. Test the specific feature/game
4. Take screenshots to verify visual elements
5. Check browser console for any errors
```

## Testing Approach

- Feature tests for HTTP endpoints and user flows
- Unit tests for isolated business logic
- SQLite in-memory database for test speed
- Test database transactions rolled back after each test
- Browser testing via browsermcp for interactive features