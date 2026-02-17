<?php

namespace App\Filament\Resources\SiteSettingResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class SiteSettingForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Settings')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('General Settings')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('key')
                                        ->required()
                                        ->maxLength(255)
                                        ->unique(ignoreRecord: true)
                                        ->helperText('Unique identifier for this setting'),
                                    
                                    Forms\Components\Select::make('type')
                                        ->required()
                                        ->options([
                                            'text' => 'Text',
                                            'textarea' => 'Text Area',
                                            'number' => 'Number',
                                            'boolean' => 'Yes/No',
                                            'json' => 'JSON',
                                            'image' => 'Image',
                                            'email' => 'Email',
                                            'url' => 'URL',
                                            'color' => 'Color',
                                        ])
                                        ->reactive()
                                        ->default('text'),
                                    
                                    Forms\Components\Select::make('group')
                                        ->required()
                                        ->options([
                                            'general' => 'General',
                                            'seo' => 'SEO',
                                            'social' => 'Social Media',
                                            'contact' => 'Contact',
                                            'footer' => 'Footer',
                                            'analytics' => 'Analytics',
                                            'custom' => 'Custom',
                                        ])
                                        ->default('general'),
                                ]),
                            
                            // Dynamic field based on type
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\TextInput::make('value')
                                        ->label('Value')
                                        ->visible(fn (callable $get) => $get('type') === 'text'),
                                    
                                    Forms\Components\Textarea::make('value')
                                        ->label('Value')
                                        ->rows(5)
                                        ->visible(fn (callable $get) => $get('type') === 'textarea'),
                                    
                                    Forms\Components\TextInput::make('value')
                                        ->label('Value')
                                        ->numeric()
                                        ->visible(fn (callable $get) => $get('type') === 'number'),
                                    
                                    Forms\Components\Select::make('value')
                                        ->label('Value')
                                        ->options([
                                            '1' => 'Yes',
                                            '0' => 'No',
                                        ])
                                        ->visible(fn (callable $get) => $get('type') === 'boolean'),
                                    
                                    Forms\Components\KeyValue::make('value')
                                        ->label('Value')
                                        ->visible(fn (callable $get) => $get('type') === 'json'),
                                    
                                    Forms\Components\FileUpload::make('value')
                                        ->label('Value')
                                        ->image()
                                        ->directory('settings')
                                        ->visible(fn (callable $get) => $get('type') === 'image'),
                                    
                                    Forms\Components\TextInput::make('value')
                                        ->label('Value')
                                        ->email()
                                        ->visible(fn (callable $get) => $get('type') === 'email'),
                                    
                                    Forms\Components\TextInput::make('value')
                                        ->label('Value')
                                        ->url()
                                        ->visible(fn (callable $get) => $get('type') === 'url'),
                                    
                                    Forms\Components\ColorPicker::make('value')
                                        ->label('Value')
                                        ->visible(fn (callable $get) => $get('type') === 'color'),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('SEO Settings')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('seo_title')
                                        ->label('Default SEO Title')
                                        ->maxLength(60)
                                        ->helperText('Recommended max 60 characters'),
                                    
                                    Forms\Components\Textarea::make('seo_description')
                                        ->label('Default SEO Description')
                                        ->rows(3)
                                        ->maxLength(160)
                                        ->helperText('Recommended max 160 characters'),
                                    
                                    Forms\Components\TagsInput::make('seo_keywords')
                                        ->label('Default SEO Keywords')
                                        ->placeholder('Add keyword'),
                                    
                                    Forms\Components\FileUpload::make('og_image')
                                        ->label('Default OG Image')
                                        ->image()
                                        ->directory('seo')
                                        ->helperText('Recommended size: 1200x630px'),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Contact Settings')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('contact_email')
                                        ->email()
                                        ->label('Contact Email'),
                                    Forms\Components\TextInput::make('contact_phone')
                                        ->label('Contact Phone'),
                                    Forms\Components\Textarea::make('contact_address')
                                        ->label('Address')
                                        ->rows(3),
                                    Forms\Components\TextInput::make('map_latitude')
                                        ->label('Map Latitude')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('map_longitude')
                                        ->label('Map Longitude')
                                        ->numeric(),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Social Media')
                        ->schema([
                            Forms\Components\Repeater::make('social_links')
                                ->schema([
                                    Forms\Components\Select::make('platform')
                                        ->options([
                                            'facebook' => 'Facebook',
                                            'twitter' => 'Twitter/X',
                                            'instagram' => 'Instagram',
                                            'linkedin' => 'LinkedIn',
                                            'github' => 'GitHub',
                                            'youtube' => 'YouTube',
                                            'tiktok' => 'TikTok',
                                            'pinterest' => 'Pinterest',
                                        ])
                                        ->required(),
                                    Forms\Components\TextInput::make('url')
                                        ->url()
                                        ->required()
                                        ->prefix('https://'),
                                    Forms\Components\Toggle::make('is_active')
                                        ->default(true),
                                ])
                                ->columns(3)
                                ->defaultItems(0),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Analytics')
                        ->schema([
                            Forms\Components\Textarea::make('google_analytics')
                                ->label('Google Analytics Code')
                                ->rows(5)
                                ->helperText('Paste your Google Analytics tracking code'),
                            
                            Forms\Components\Textarea::make('facebook_pixel')
                                ->label('Facebook Pixel Code')
                                ->rows(5)
                                ->helperText('Paste your Facebook Pixel code'),
                            
                            Forms\Components\TextInput::make('google_site_verification')
                                ->label('Google Site Verification'),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Footer')
                        ->schema([
                            Forms\Components\Textarea::make('footer_text')
                                ->label('Footer Text')
                                ->rows(3)
                                ->default('© ' . date('Y') . ' All rights reserved.'),
                            
                            Forms\Components\Toggle::make('show_copyright')
                                ->label('Show Copyright')
                                ->default(true),
                            
                            Forms\Components\Repeater::make('footer_links')
                                ->schema([
                                    Forms\Components\TextInput::make('label')
                                        ->required(),
                                    Forms\Components\TextInput::make('url')
                                        ->required(),
                                ])
                                ->columns(2)
                                ->defaultItems(0),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}