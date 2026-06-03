<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Profile;

class BloodRequest extends Model
{
    protected $fillable = [
        'user_id',
        'patient_name',
        'blood_group',
        'hospital',
        'location',
        'contact_phone',
        'message',
        'urgency',
        'status',
        'matched_donors_count',
        'fulfilled_at',
    ];

    protected $casts = [
        'fulfilled_at' => 'datetime',
    ];

    const URGENCIES = ['critical', 'urgent', 'normal'];
    const STATUSES = ['pending', 'matched', 'fulfilled', 'cancelled'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function findMatchingDonors()
    {
        $eligibleProfiles = Profile::where('blood', $this->blood_group)
            ->where('user_id', '!=', $this->user_id)
            ->whereNotNull('number')
            ->whereNotNull('name')
            ->get();

        $matched = [];
        foreach ($eligibleProfiles as $profile) {
            if ($profile->last_donated) {
                $nextDate = $profile->nextDonationDate();
                if ($nextDate && now()->startOfDay()->lt($nextDate)) {
                    continue;
                }
            }
            $matched[] = $profile;
        }

        return collect($matched);
    }
}
