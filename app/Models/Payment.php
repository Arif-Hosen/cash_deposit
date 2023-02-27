<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
   protected $fillable = [
    'name',
    'name_key',
    'user_id',
    'mobile',
    'image',
    'payment_number_id',
    'status',
   ];
   public static $statusArray = ['active','inactive'];
   public static $paymentMethods = [
    'bkash_agent' => 'Bkash Agent',
    'bkash_personal' => 'Bkash Personal',
    'nagad_personal' => 'Nagad Personal',
    'rocket_personal' => 'Rocket Personal',
    'upay_personal' => 'Upay Personal',
   ];
   public function numbers(){
    return $this->hasMany(Payment_number::class,'method_id','id');
   }


}
