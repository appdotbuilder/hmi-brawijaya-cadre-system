<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CadreProfile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $nik
 * @property string $full_name
 * @property \Illuminate\Support\Carbon $birth_date
 * @property string $birth_place
 * @property string $gender
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $student_id
 * @property string $institution
 * @property string $faculty
 * @property string $komisariat
 * @property string|null $study_program
 * @property int|null $entry_year
 * @property string $membership_status
 * @property \Illuminate\Support\Carbon|null $join_date
 * @property string|null $position
 * @property string|null $avatar
 * @property bool $is_verified
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property int|null $verified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User|null $verifier
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|CadreProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CadreProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CadreProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|CadreProfile verified()
 * @method static \Illuminate\Database\Eloquent\Builder|CadreProfile unverified()

 * 
 * @mixin \Eloquent
 */
class CadreProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'nik',
        'full_name',
        'birth_date',
        'birth_place',
        'gender',
        'phone',
        'address',
        'student_id',
        'institution',
        'faculty',
        'komisariat',
        'study_program',
        'entry_year',
        'membership_status',
        'join_date',
        'position',
        'avatar',
        'is_verified',
        'verified_at',
        'verified_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'entry_year' => 'integer',
    ];

    /**
     * Get the user that owns the cadre profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who verified this profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Scope a query to only include verified profiles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to only include unverified profiles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnverified($query)
    {
        return $query->where('is_verified', false);
    }
}