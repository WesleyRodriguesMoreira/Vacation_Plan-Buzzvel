<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    // Enter the name of the table
    protected $table = 'vacation_plan';

    // Indicate Which Columns Can Perform Operations
    protected $fillable = ['title', 'description', 'date', 'local'];

    // public function situacaoConta()
    // {
    //     return $this->belongsTo(SituacaoConta::class);
    // }
}
