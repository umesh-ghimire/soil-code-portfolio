<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Profile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'title',
        'bio',
        'email',
        'phone',
        'location',
        'greeting',
        'nepali_text',
        'profile_image',
        'resume_file',
        'years_experience',
        'total_projects',
        'open_source_contributions',
        'social_links'
    ];

    protected $casts = [
        'social_links' => 'array',
        'years_experience' => 'integer',
        'total_projects' => 'integer',
        'open_source_contributions' => 'integer'
    ];

    /**
     * Get the profile's profile image
     */
    public function getProfileImageUrlAttribute(): ?string
    {
        return $this->profile_image 
            ? asset('storage/' . $this->profile_image) 
            : null;
    }


    // Optional helper
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }
    /**
     * Get a specific social link
     */
    public function getSocialLink(string $platform): ?string
    {
        return $this->social_links[$platform] ?? null;
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('resume')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
    }
}