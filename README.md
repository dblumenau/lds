# Swift Danish (LDS) - Learn Danish Swiftly

An interactive language learning platform built with Laravel and Vue.js to help users learn Danish through engaging mini-games and personalized vocabulary practice.

## 🚀 Quick Setup

### Option 1: Using the setup script (Recommended)
```bash
git clone <repository-url>
cd lds
./bin/setup
```

### Option 2: Using Composer
```bash
git clone <repository-url>
cd lds
composer install
composer setup  # This runs all setup steps
```

### Option 3: Manual setup
```bash
git clone <repository-url>
cd lds

# Copy environment file
cp .env.example .env

# Install dependencies
composer install
npm install

# Generate application key
php artisan key:generate

# Create SQLite database
touch database/database.sqlite

# Run migrations with seeders
php artisan migrate:fresh --seed

# Build assets
npm run build
```

## 🏃 Running the Application

### Development
```bash
# Start both Laravel and Vite dev servers
npm run dev  # In one terminal
php artisan serve  # In another terminal

# Or use the VS Code task (if using VS Code)
# Run Task > start
```

### Production Build
```bash
npm run build
```

## 🎮 Features

- **Interactive Mini-Games**
  - Matching Pairs - Memory card game
  - Match Madness - Fast-paced timed matching
  - Word Builder (planned)
  - Sentence Constructor (planned)

- **User Management**
  - Registration with admin approval workflow
  - Super admin role for user management
  - Personalized word lists

## 🔐 Default Credentials

After running seeders, you can log in with:
- **Email**: admin@example.com
- **Password**: password

## 📚 Documentation

- Project planning documents: `docs/planning/`
- Game designs: `docs/designs/`
- Claude AI instructions: `CLAUDE.md`

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Vue 3, Alpine.js, Tailwind CSS
- **Database**: SQLite
- **Asset Bundler**: Vite
- **Authentication**: Laravel Breeze

## 📝 VS Code Workspace

This project includes a VS Code workspace file (`lds.code-workspace`) with pre-configured tasks:
- `start` - Run both Laravel and Vite servers
- `fresh-start` - Complete setup and start servers
- `test` - Run PHPUnit tests
- And more...

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 🤝 Contributing

Please read the contributing guidelines in the Laravel documentation before submitting pull requests.

## 📄 License

This project is proprietary software. All rights reserved. This code is not open source and may not be used, modified, or distributed without explicit written permission from the owner.
