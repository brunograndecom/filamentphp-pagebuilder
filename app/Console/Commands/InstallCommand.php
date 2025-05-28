<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install {--fresh : Drop all tables and re-run all migrations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application by running migrations and seeding the database with a Filament admin user';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Starting application installation...');
        $this->newLine();

        $fresh = $this->option('fresh');

        try {
            // Step 1: Run migrations
            $this->info('📦 Running database migrations...');
            if ($fresh) {
                $this->call('migrate:fresh', ['--force' => true]);
            } else {
                $this->call('migrate', ['--force' => true]);
            }
            $this->info('✅ Database migrations completed successfully.');
            $this->newLine();

            // Step 2: Seed the database with admin user
            $this->info('👤 Creating Filament admin user...');
            $this->call('db:seed', [
                '--class' => 'Database\\Seeders\\FilamentAdminSeeder',
                '--force' => true
            ]);
            $this->info('✅ Filament admin user created successfully.');
            $this->newLine();

            // Step 3: Clear and cache config
            $this->info('🔧 Optimizing application...');
            $this->call('optimize:clear');
            $this->info('✅ Application optimization completed.');
            $this->newLine();

            // Success message
            $this->info('🎉 Application installation completed successfully!');
            $this->newLine();
            $this->line('<fg=green>Admin User Credentials:</>');
            $this->line('<fg=yellow>Email:</> admin@example.com');
            $this->line('<fg=yellow>Password:</> Password123');
            $this->newLine();
            $this->line('<fg=cyan>You can now access the Filament admin panel at:</> ' . config('app.url') . '/admin');

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Installation failed: ' . $e->getMessage());
            $this->newLine();
            $this->line('<fg=red>Please check the error above and try again.</>');

            return self::FAILURE;
        }
    }
}
