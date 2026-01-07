<?php
namespace App\Models;
use CodeIgniter\Model;

class BudgetModel extends Model {
    protected $table = 'budgets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category','amount'];
}
