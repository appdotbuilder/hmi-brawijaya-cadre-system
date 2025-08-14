<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property bool $is_verified
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\CadreProfile|null $cadreProfile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LibraryItem> $createdLibraryItems
 * @property-read int|null $created_library_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BookLoan> $bookLoans
 * @property-read int|null $book_loans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendanceEvent> $createdAttendanceEvents
 * @property-read int|null $created_attendance_events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendanceRecord> $attendanceRecords
 * @property-read int|null $attendance_records_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * 
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User administrators()
 * @method static \Illuminate\Database\Eloquent\Builder|User management()
 * @method static \Illuminate\Database\Eloquent\Builder|User cadres()
 * @method static \Illuminate\Database\Eloquent\Builder|User verified()
 * @method static \Illuminate\Database\Eloquent\Builder|User unverified()
 * 
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_verified',
        'verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Get the cadre profile associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cadreProfile(): HasOne
    {
        return $this->hasOne(CadreProfile::class);
    }

    /**
     * Get the library items created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdLibraryItems(): HasMany
    {
        return $this->hasMany(LibraryItem::class, 'created_by');
    }

    /**
     * Get the book loans for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookLoans(): HasMany
    {
        return $this->hasMany(BookLoan::class, 'cadre_id');
    }

    /**
     * Get the attendance events created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdAttendanceEvents(): HasMany
    {
        return $this->hasMany(AttendanceEvent::class, 'created_by');
    }

    /**
     * Get the attendance records for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class, 'cadre_id');
    }

    /**
     * Scope a query to only include administrators.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdministrators($query)
    {
        return $query->where('role', 'administrator');
    }

    /**
     * Scope a query to only include management users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeManagement($query)
    {
        return $query->where('role', 'management');
    }

    /**
     * Scope a query to only include cadres.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCadres($query)
    {
        return $query->where('role', 'cadre');
    }

    /**
     * Scope a query to only include verified users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to only include unverified users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnverified($query)
    {
        return $query->where('is_verified', false);
    }

    /**
     * Check if user is administrator.
     *
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->role === 'administrator';
    }

    /**
     * Check if user is management.
     *
     * @return bool
     */
    public function isManagement(): bool
    {
        return $this->role === 'management';
    }

    /**
     * Check if user is cadre.
     *
     * @return bool
     */
    public function isCadre(): bool
    {
        return $this->role === 'cadre';
    }
}