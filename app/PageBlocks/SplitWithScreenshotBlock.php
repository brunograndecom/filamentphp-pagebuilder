<?php

namespace App\PageBlocks;

use Filament\Forms;

class SplitWithScreenshotBlock
{
    public static function make(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('split-with-screenshot')
            ->label(function (?array $state): string {
                if ($state === null) {
                    return 'Split with screenshot';
                }

                return $state['title'] ? $state['title'] . ' | Split with screenshot |' : 'Split with screenshot |';
            })
            ->schema([
                Forms\Components\Section::make()
                    ->description('Top section')
                    ->schema([
                        Forms\Components\TextInput::make('top_pill_text')
                            ->label('Pill text'),
                        Forms\Components\TextInput::make('top_text')
                            ->label('Text'),
                        Forms\Components\TextInput::make('top_link')
                            ->label('Link'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make()
                    ->description('Main section')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required(),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitle')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make()
                    ->description('Bottom section')
                    ->schema([
                        Forms\Components\TextInput::make('button1_text')
                            ->label('Button 1 text'),
                        Forms\Components\TextInput::make('button1_link')
                            ->label('Button 1 link'),
                        Forms\Components\TextInput::make('button2_text')
                            ->label('Button 2 text'),
                        Forms\Components\TextInput::make('button2_link')
                            ->label('Button 2 link'),
                    ])
                    ->columns(2),

                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
