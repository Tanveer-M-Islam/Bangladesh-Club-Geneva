<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'blood_group',
        'gender',
        'address',
        'payment_proof',
        'member_photo',
        'status',
    ];

    protected static function booted()
    {
        static::updated(function ($application) {
            // Check if status was changed to active
            if ($application->wasChanged('status') && $application->status === 'active') {
                $setting = \App\Models\AboutBcgSetting::first();
                
                if ($setting) {
                    $generalMembers = $setting->general_members ?? [];
                    
                    // Check if the member is already synced (e.g., by email)
                    $exists = collect($generalMembers)->contains('email', $application->email);
                    
                    if (!$exists) {
                        $generalMembers[] = [
                            'name' => $application->name,
                            'email' => $application->email,
                            'phone' => $application->contact_number,
                            'blood_group' => $application->blood_group,
                            'image_path' => $application->member_photo,
                        ];
                        
                        $setting->update(['general_members' => $generalMembers]);
                    }
                }
            }
        });
    }
}
