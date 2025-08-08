<?php

namespace App\Filament\Resources\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ResourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('course_name')
                    ->required(),
                TextInput::make('file_path')
                    ->required(),
                TextInput::make('upvote_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
