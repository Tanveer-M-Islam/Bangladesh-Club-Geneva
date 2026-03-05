<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'bank_iban',
        'bank_account_name',
        'qr_code_path',
        'payment_note',
    ];
}
