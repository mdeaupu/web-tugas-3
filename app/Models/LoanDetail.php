<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $table = 'loan_detail';

    protected $fillable = [
        'loan_id',
        'book_id',
        'is_return',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function returnRecord()
    {
        return $this->hasOne(BookReturn::class, 'loan_detail_id');
    }
}
