<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Traits\BelongsToAccount;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ApprovalNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, BelongsToAccount;

    protected $fillable = [
        'user_id',
        'account_id',
        'model_type', // the tickatable
        'model_id',
        'action',
        'new_state',
        'old_state',
        'status',
        'approved_at',
        'approved_at_by_user_id',
        'approver_notes',
        'requestor_notes',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    const ACTION_DELETE = 'Delete';
    const ACTION_UPDATE = 'Update';

    const STATUS_PENDING = 'Pending';
    const STATUS_APPROVED = 'Approved';
    const STATUS_DECLINED = 'Declined';

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_at_by_user_id');
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function applyTicket()
    {
        $newContent = json_decode($this->new_state, true);
        $this->model->update($newContent);
        $type = Str::headline(basename($this->model_type));
        $title = $this->model->title;
        Notification::send(
            $this->user,
            new ApprovalNotification("Your ticket for your $type: \"$title\" has been approved.", "#")
        );
    }

    public function approve($approverId = null, $approverNotes = null)
    {
        $this->update([
            'approver_notes' => $approverNotes ?? 'sample note',
            'approved_at' => now(),
            'approved_at_by_user_id' => $approverId ?? 1,
            'status' => self::STATUS_APPROVED,
        ]);

        if ($this->action === self::ACTION_UPDATE) {
            $this->applyTicket();
        }
    }

    public function revertChanges()
    {
        $oldState = json_decode($this->old_state, true);
        $this->model->update($oldState);
    }
}
