<?php

namespace App\PageBlocks;

use Filament\Forms;

class CenteredOnDarkPanelBlock
{
    public static function make(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('centered-on-dark-panel')
            ->label(function (?array $state): string {
                if ($state === null) {
                    return 'CenteredOnDarkPanel';
                }

                return $state['title'] ? $state['title'] . ' | CenteredOnDarkPanel |' : 'CenteredOnDarkPanel |';
            })
            ->schema([
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
            ])
            ->columns(2);
    }
}
