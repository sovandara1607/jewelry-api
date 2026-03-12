<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class CreatePlaceholderImages extends Seeder
{
   public function run(): void
   {
      // Ensure the product-images directory exists
      Storage::disk('public')->makeDirectory('product-images');

      // Get all unique image paths from the database
      $imagePaths = ProductImage::distinct()->pluck('image_path');

      $imageCounter = 1;

      foreach ($imagePaths as $imagePath) {
         // Skip if it's already a full URL
         if (str_starts_with($imagePath, 'http')) {
            continue;
         }

         // Skip if file already exists
         if (Storage::disk('public')->exists($imagePath)) {
            echo "File already exists: {$imagePath}\n";
            continue;
         }

         try {
            // Generate a unique placeholder image for each file
            $placeholderUrl = "https://picsum.photos/seed/jewelry{$imageCounter}/400/400";

            // Download the placeholder image
            $response = Http::timeout(10)->get($placeholderUrl);

            if ($response->successful()) {
               // Save the image with the original filename
               Storage::disk('public')->put($imagePath, $response->body());
               echo "Created: {$imagePath}\n";
            } else {
               echo "Failed to download for: {$imagePath}\n";
            }

            $imageCounter++;

            // Small delay to be respectful to the API
            usleep(100000); // 0.1 second

         } catch (\Exception $e) {
            echo "Error creating {$imagePath}: {$e->getMessage()}\n";
         }
      }

      echo "Placeholder image creation completed!\n";
   }
}