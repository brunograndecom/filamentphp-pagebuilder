# Filament Page Builder

This is a Laravel application with Filament backend that allows you to create pages using a visual editor.

My task here was to create pre-defined blocks that can be used to create page content.

## Installation 

Create a `.env` file by copying the `.env.example` file and filling in the correct values.

Then run:
```bash
composer install
php artisan key:generate
npm install && npm run build
```

This application includes a custom installation command that sets up the application and creates a Filament admin user automatically.

### Quick Installation

To install the application, simply run:

```bash
php artisan app:install
```

This command will:
1. Run database migrations
2. Create a Filament admin user with predefined credentials
3. Clear and optimize application caches

### Fresh Installation

If you want to start with a completely clean database (dropping all existing tables):

```bash
php artisan app:install --fresh
```

**⚠️ Warning:** The `--fresh` option will drop all existing tables and data. Use with caution!

### Default Admin Credentials

After installation, you can access the Filament admin panel with these credentials:

- **URL**: `{APP_URL}/admin` (e.g., `http://localhost/admin`)
- **Email**: `admin@example.com`
- **Password**: `Password123`

### What Gets Created

#### 1. Database Tables
The installation runs all Laravel migrations, creating:
- `users` table
- `cache` table  
- `jobs` table
- `password_reset_tokens` table
- `sessions` table
- `pages` table

#### 2. Admin User
A Filament admin user is created with:
- Name: `admin`
- Email: `admin@example.com`
- Password: `Password123`
- Email verified timestamp set to current time

## Page Blocks

The application comes with a set of pre-defined blocks that can be used to create page content.

### Creating a new block

To create a new block, run:
```bash
php artisan make:page-block NewBlock
```

This will create a new block class in the `app/PageBlocks` directory and a new blade component in the `app/View/Components/Blocks` directory with its own view file.

### Available Blocks

The application comes with the following blocks as examples, based on Tailwind Plus UI Blocks:

- `SplitWithScreenshotBlock` - based on: https://tailwindcss.com/plus/ui-blocks/marketing/sections/heroes#component-54294e7b86ddf5371565dbdfd133d79c
- `CenteredOnDarkPanelBlock` - based on: https://tailwindcss.com/plus/ui-blocks/marketing/sections/cta-sections#component-e96076d46250608ad1a5306c03921371
