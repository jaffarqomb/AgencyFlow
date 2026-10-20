<?php

namespace App\Filament\Resources\Quotations\Schemas;

use App\Models\Client;
use App\Models\Project;
use App\Models\Quotation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('quotation_number')
                    ->label('Quotation Number')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->unique(ignoreRecord: true)
                    ->default(function () {
                        // This generates a visual preview for the user on the "Create" form
                        $latestId = Quotation::max('id') ?? 0;

                        return 'QUT-'.date('Y').'-'.str_pad($latestId + 1, 4, '0', STR_PAD_LEFT);
                    }), // Ensure the value is included in the form submission
                Select::make('client_id')
                    ->label('Client Name')
                    ->placeholder('Select a client or Company Name')
                    ->options(Client::pluck('company_name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('project_id')
                    ->label('Project Name')
                    ->options(Project::pluck('project_name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('title')
                    ->label('Quotation Title')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('subtotal')
                    ->helperText('This will be calculated automatically based on the items added to the quotation.')
                    ->label('Sub Total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('tax_rate')
                    ->label('Tax Rate (%)')
                    ->required()
                    ->numeric()
                    ->default(0.1)
                    ->disabled(),
                TextInput::make('tax_amount')
                    ->label('Tax Amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ])->default('draft'),
                DatePicker::make('valid_until'),

                Textarea::make('scope_summary')
                    ->label('Scope Summary')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);

    }
}
