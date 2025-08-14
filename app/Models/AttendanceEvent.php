<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\AttendanceEvent
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $activity_type
 * @property string|null $field
 * @property string|null $department
 * @property \Illuminate\Support\Carbon $event_date
 * @property \Illuminate\Support\Carbon $registration_start
 * @property \Illuminate\Support\Carbon $registration_end
 * @property string|null $location
 * @property int|null $max_participants
 * @property bool $is_mandatory
 * @property string $target_audience
 * @property string|null $target_komisariat
 * @property bool $is_active
 * @property string|null $qr_code
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendanceRecord> $attendanceRecords
 * @property-read int|null $attendance_records_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEvent active()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEvent upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEvent mandatory()

 * 
 * @mixin \Eloquent
 */
class AttendanceEvent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'activity_type',
        'field',
        'department',
        'event_date',
        'registration_start',
        'registration_end',
        'location',
        'max_participants',
        'is_mandatory',
        'target_audience',
        'target_komisariat',
        'is_active',
        'qr_code',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'datetime',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'is_mandatory' => 'boolean',
        'is_active' => 'boolean',
        'max_participants' => 'integer',
    ];

    /**
     * Get the user who created this event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all attendance records for this event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    /**
     * Scope a query to only include active events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include upcoming events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>', now());
    }

    /**
     * Scope a query to only include mandatory events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMandatory($query)
    {
        return $query->where('is_mandatory', true);
    }
}