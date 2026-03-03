<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationSetting extends Model
{
    protected $fillable = [
        'bank_name',
        'bank_iban',
        'bank_account_name',
        'twint_number',
        'donation_note',
    ];
}
