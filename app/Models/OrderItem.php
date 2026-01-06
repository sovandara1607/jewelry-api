<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * We MUST specify this because our table name is 'orderitem' (singular)
     * and not 'order_items' (plural).
     * @var string
     */
    protected $table = 'orderitem';

    /**
     * The primary key associated with the table.
     * We must specify this because it is 'orderitem_id' and not the default 'id'.
     * @var string
     */
    protected $primaryKey = 'orderitem_id';

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The name of the "created at" column.
     * @var string
     */
    const CREATED_AT = 'date_created';

    /**
     * The name of the "updated at" column.
     * @var string
     */
    const UPDATED_AT = 'date_updated';

    /**
     * The attributes that are mass assignable.
     * These must match your table's column names exactly.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price', // Note: your column is lowercase 'price', not 'Price'
    ];

    /**
     * Get the order that this item belongs to.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the product associated with this order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}