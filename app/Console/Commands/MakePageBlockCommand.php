<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakePageBlockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:page-block {name : The name of the page block}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new page block with all necessary files';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        $className = Str::studly($name);
        $kebabName = Str::kebab($name);

        $this->info("🚀 Creating page block: {$className}");
        $this->newLine();

        try {
            // Create PageBlock class
            $this->createPageBlockClass($className, $kebabName);
            $this->components->info("PageBlock [app/PageBlocks/{$className}Block.php] created successfully.");

            // Create View Component
            $this->createViewComponent($className, $kebabName);

            $this->newLine();
            $this->info("🎉 Page block '{$className}' created successfully!");
            $this->newLine();
            $this->line("<fg=yellow>Don't forget to:</>");
            $this->line("1. Add \\App\\PageBlocks\\{$className}Block::make() to your PageBlocksServiceProvider");
            $this->line("2. Customize the schema in {$className}Block.php");
            $this->line("3. Design your blade template in resources/views/components/blocks/{$kebabName}.blade.php");

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error("❌ Failed to create page block: " . $e->getMessage());
            return self::FAILURE;
        }
    }

    /**
     * Create the PageBlock class file.
     */
    protected function createPageBlockClass(string $className, string $kebabName): void
    {
        $directory = app_path('PageBlocks');
        $this->ensureDirectoryExists($directory);

        $stub = $this->getPageBlockStub();
        $content = str_replace(
            ['{{className}}', '{{kebabName}}'],
            [$className, $kebabName],
            $stub
        );

        $path = $directory . "/{$className}Block.php";
        $this->files->put($path, $content);
    }

    /**
     * Create the View Component class file using Laravel's make:component command.
     */
    protected function createViewComponent(string $className, string $kebabName): void
    {
        // Use Laravel's make:component command to create the component
        $this->call('make:component', [
            'name' => "Blocks/{$className}",
        ]);

        // Update the generated component
        $componentPath = app_path("View/Components/Blocks/{$className}.php");

        if ($this->files->exists($componentPath)) {
            $content = $this->files->get($componentPath);

            // Replace the constructor to accept blockData array
            $content = preg_replace(
                '/public function __construct\(\)\s*\{[^}]*\}/s',
                'public function __construct(public array $blockData)
    {
        //
    }',
                $content
            );

            $this->files->put($componentPath, $content);
        }
    }

    /**
     * Ensure the given directory exists.
     */
    protected function ensureDirectoryExists(string $directory): void
    {
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    /**
     * Get the PageBlock class stub.
     */
    protected function getPageBlockStub(): string
    {
        return '<?php

namespace App\PageBlocks;

use Filament\Forms;

class {{className}}Block
{
    public static function make(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make(\'{{kebabName}}\')
            //->label(function (?array $state): string {
            //     if ($state === null) {
            //         return \'{{className}}\';
            //     }

            //     return $state[\'title\'] ? $state[\'title\'] . \' | {{className}} |\' : \'{{className}} |\';
            // })
            ->schema([
                // Add your form fields here
            ])
            ->columns(2);
    }
}
';
    }
}
