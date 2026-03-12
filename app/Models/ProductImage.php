<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'product_id',
        'image_path',
    ];

    /**
     * Append custom attributes to the model.
     */
    protected $appends = ['image_url'];

    /**
     * Get the full URL for the image.
     * Handles both external URLs and local storage paths.
     * Provides fallback for missing files.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image_path)) {
            return null;
        }

        // If it's already a full URL, return as-is
        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        // For local storage paths, check if file exists
        if (Storage::disk('public')->exists($this->image_path)) {
            return Storage::url($this->image_path);
        }

        // Fallback to placeholder image if file doesn't exist
        $productId = $this->product_id ?? 1;
        return "https://picsum.photos/seed/jewelry{$productId}/400/400";
    }

    /**
     * Get the product that this image belongs to.
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id', 'product_id');
    }
}