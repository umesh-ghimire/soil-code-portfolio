<?php

namespace App\Filament\Resources\BlogPostResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Blog Post')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Content')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                    Forms\Components\TextInput::make('slug')
                                        ->required()
                                        ->maxLength(255)
                                        ->unique(ignoreRecord: true),
                                ]),
                            
                            Forms\Components\Textarea::make('excerpt')
                                ->rows(3)
                                ->maxLength(500)
                                ->helperText('A brief summary of the post (optional)'),
                            
                            Forms\Components\RichEditor::make('content')
                                ->required()
                                ->fileAttachmentsDirectory('blog/content')
                                ->toolbarButtons([
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'h4',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                                ])
                                ->columnSpanFull(),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\FileUpload::make('featured_image')
                                ->label('Featured Image')
                                ->image()
                                ->directory('blog/featured')
                                ->visibility('public')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '21:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->maxSize(5120)
                                ->helperText('Recommended size: 1200x630px. Max 5MB.'),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Categories & Tags')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('category')
                                        ->options([
                                            'development' => 'Development',
                                            'design' => 'Design',
                                            'tutorial' => 'Tutorial',
                                            'news' => 'News',
                                            'thoughts' => 'Thoughts',
                                            'case-study' => 'Case Study',
                                        ])
                                        ->searchable(),
                                    
                                    Forms\Components\TagsInput::make('tags')
                                        ->placeholder('Add tag')
                                        ->splitKeys(['Tab', ','])
                                        ->suggestions([
                                            'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React',
                                            'Tailwind CSS', 'Filament', 'Livewire', 'Alpine.js',
                                            'Tutorial', 'Guide', 'Tips', 'Best Practices',
                                        ]),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->schema([
                            Forms\Components\Section::make('SEO Metadata')
                                ->schema([
                                    Forms\Components\TextInput::make('seo_metadata.meta_title')
                                        ->maxLength(60)
                                        ->helperText('Recommended: 50-60 characters'),
                                    
                                    Forms\Components\Textarea::make('seo_metadata.meta_description')
                                        ->rows(2)
                                        ->maxLength(160)
                                        ->helperText('Recommended: 150-160 characters'),
                                    
                                    Forms\Components\TagsInput::make('seo_metadata.keywords')
                                        ->placeholder('Add keyword')
                                        ->splitKeys(['Tab', ',']),
                                    
                                    Forms\Components\TextInput::make('seo_metadata.canonical_url')
                                        ->url()
                                        ->maxLength(255),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\Grid::make(3)
                                ->schema([
                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Featured Post')
                                        ->helperText('Show this post in featured section')
                                        ->default(false),
                                    
                                    Forms\Components\Toggle::make('is_published')
                                        ->label('Published')
                                        ->helperText('Make this post visible on the website')
                                        ->reactive()
                                        ->afterStateUpdated(fn ($state, callable $set) => 
                                            $state ? $set('published_at', now()) : null
                                        )
                                        ->default(false),
                                    
                                    Forms\Components\DateTimePicker::make('published_at')
                                        ->label('Publish Date')
                                        ->required(fn ($get) => $get('is_published'))
                                        ->maxDate(now()),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}