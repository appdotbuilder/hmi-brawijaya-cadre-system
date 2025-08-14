<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AttendanceRecord
 *
 * @property int $id
 * @property int $attendance_event_id
 * @property int $cadre_id
 * @property \Illuminate\Support\Carbon $check_in_time
 * @property \Illuminate\Support\Carbon|null $check_out_time
 * @property string $status
 * @property string|null $notes
 * @property string $check_in_method
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property float|null $latitude
 * @property float|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\AttendanceEvent $attendanceEvent
 * @property-read \App\Models\User $cadre
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceRecord present()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceRecord absent()

 * 
 * @mixin \Eloquent
 */
class AttendanceRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'attendance_event_id',
        'cadre_id',
        'check_in_time',
        'check_out_time',
        'status',
        'notes',
        'check_in_method',
        'ip_address',
        'user_agent',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the attendance event this record belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendanceEvent(): BelongsTo
    {
        return $this->belongsTo(AttendanceEvent::class);
    }

    /**
     * Get the cadre who made this attendance record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cadre(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cadre_id');
    }

    /**
     * Scope a query to only include present records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePresent($query)
    {
        return $query->where('status', 'present');
    }

    /**
     * Scope a query to only include absent records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAbsent($query)
    {
        return $query->where('status', 'absent');
    }
}