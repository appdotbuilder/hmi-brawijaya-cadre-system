<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\LibraryItem
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $publisher
 * @property int|null $publication_year
 * @property string $type
 * @property string|null $category
 * @property string $language
 * @property int|null $pages
 * @property string|null $digital_url
 * @property int $total_copies
 * @property int $available_copies
 * @property string|null $location
 * @property string|null $cover_image
 * @property bool $is_active
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BookLoan> $loans
 * @property-read int|null $loans_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryItem active()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryItem digital()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryItem print()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryItem available()

 * 
 * @mixin \Eloquent
 */
class LibraryItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'publisher',
        'publication_year',
        'type',
        'category',
        'language',
        'pages',
        'digital_url',
        'total_copies',
        'available_copies',
        'location',
        'cover_image',
        'is_active',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'publication_year' => 'integer',
        'pages' => 'integer',
        'total_copies' => 'integer',
        'available_copies' => 'integer',
    ];

    /**
     * Get the user who created this library item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all loans for this library item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loans(): HasMany
    {
        return $this->hasMany(BookLoan::class);
    }

    /**
     * Scope a query to only include active items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include digital items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDigital($query)
    {
        return $query->where('type', 'digital');
    }

    /**
     * Scope a query to only include print items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePrint($query)
    {
        return $query->where('type', 'print');
    }

    /**
     * Scope a query to only include available items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('available_copies', '>', 0);
    }
}