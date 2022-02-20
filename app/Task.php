<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    
    
    public function getFullStatusAttribute($value)
    {
        if ($this->status == 1) {
           return $this->status = 'В ожидании';
        } else if ($this->status == 2) {
            return $this->status = 'В разработке';
        } else if ($this->status == 3) {
            return $this->status = 'На тестировании';
        } else if ($this->status == 4) {
            return $this->status = 'На проверке';
        } else {
            return $this->status = 'Выполнено';
        }
    }
}
