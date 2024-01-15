<?php

namespace App\Models;

use App\Builders\RecipeBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Recipe extends Model
{
    use HasEagerLimit;
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'ingredients',
        'preparation',
        'image',
        'published_at',
        'user_id',
        'category_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('storage/' . $this->image),
        );
    }

    protected function publishDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->published_at->isoFormat('LLL'),
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'recipe_tag', 'recipe_id', 'tag_id')
            ->withTimestamps();
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'recipe_id', 'user_id')
            ->withTimestamps();
    }

    public function newEloquentBuilder($query): RecipeBuilder
    {
        return new RecipeBuilder($query);
    }

    public function isFavorite(int $id): bool
    {
        return $this->favorites()->where('user_id', $id)->exists();
    }

    public function isPublished(): bool
    {
        return (bool) $this->published_at && $this->published_at->isPast();
    }
}
