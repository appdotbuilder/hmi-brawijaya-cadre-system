<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BookLoan
 *
 * @property int $id
 * @property int $library_item_id
 * @property int $cadre_id
 * @property \Illuminate\Support\Carbon $requested_date
 * @property \Illuminate\Support\Carbon|null $approved_date
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property \Illuminate\Support\Carbon|null $returned_date
 * @property string $status
 * @property string|null $request_notes
 * @property string|null $admin_notes
 * @property int|null $loan_duration_days
 * @property int|null $approved_by
 * @property int|null $returned_to
 * @property float $fine_amount
 * @property bool $fine_paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\LibraryItem $libraryItem
 * @property-read \App\Models\User $cadre
 * @property-read \App\Models\User|null $approver
 * @property-read \App\Models\User|null $returnHandler
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|BookLoan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookLoan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookLoan query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookLoan pending()
 * @method static \Illuminate\Database\Eloquent\Builder|BookLoan approved()
 * @method static \Illuminate\Database\Eloquent\Builder|BookLoan overdue()

 * 
 * @mixin \Eloquent
 */
class BookLoan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'library_item_id',
        'cadre_id',
        'requested_date',
        'approved_date',
        'due_date',
        'returned_date',
        'status',
        'request_notes',
        'admin_notes',
        'loan_duration_days',
        'approved_by',
        'returned_to',
        'fine_amount',
        'fine_paid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requested_date' => 'date',
        'approved_date' => 'date',
        'due_date' => 'date',
        'returned_date' => 'date',
        'fine_amount' => 'decimal:2',
        'fine_paid' => 'boolean',
        'loan_duration_days' => 'integer',
    ];

    /**
     * Get the library item associated with this loan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libraryItem(): BelongsTo
    {
        return $this->belongsTo(LibraryItem::class);
    }

    /**
     * Get the cadre who requested this loan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cadre(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cadre_id');
    }

    /**
     * Get the user who approved this loan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the user who handled the return.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function returnHandler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'returned_to');
    }

    /**
     * Scope a query to only include pending loans.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include approved loans.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include overdue loans.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }
}