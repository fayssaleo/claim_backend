<?php

namespace App\Modules\Estimate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Valuation\Models\Valuation;
use App\Modules\Automobile\Models\Automobile;
use App\Modules\Equipment\Models\Equipment;
use App\Modules\Container\Models\Container;

class Estimate extends Model
{
    use HasFactory;
    protected $guarded= ["id"];


    public function automobile()
    {
        return $this->belongsTo(Automobile::class);
    }
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
    public function container()
    {
        return $this->belongsTo(Container::class);
    }


    protected $fillable = [
        'equipment_purchase_costs',
        'installation_and_facilities_costs',
        'rransportation_costs',
        'temporary_or_permanent',
        "claim_id",
    ];

    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
