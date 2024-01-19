<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'department_id';

    protected $fillable = [
        'company_id',
        'department_name',
        'parent_department_id',
    ];

    public function childDepartments()
    {
        return $this->hasMany(Department::class, 'parent_department_id', 'department_id');
    }
}