<?php

namespace App\Models;
use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'trans_date',
        'description',
        'amount',
        'type',
        'category',
    'account'
    ];
}
