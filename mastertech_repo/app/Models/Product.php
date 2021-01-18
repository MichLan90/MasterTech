<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Product extends Model
    {
        use SoftDeletes;

        protected $fillable = [
            'name', 'price', 'units', 'description', 'category', 'image'
        ];

        public function orders(){
            return $this->hasMany(Order::class);
        }
    }