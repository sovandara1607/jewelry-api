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
            // Use jewelry-specific keywords for better placeholder images
            $jewelryKeywords = [
               'jewelry',
               'necklace',
               'earrings',
               'bracelet',
               'ring',
               'gold',
               'silver',
               'diamond',
               'pendant',
               'chain',
               'gemstone',
               'luxury',
               'fashion',
               'accessories'
            ];

            $keyword = $jewelryKeywords[array_rand($jewelryKeywords)];

            // Try jewelry-specific image sources first
            $jewelryUrls = [
               "https://source.unsplash.com/400x400/?{$keyword},jewelry",
               "https://source.unsplash.com/400x400/?gold,{$keyword}",
               "https://source.unsplash.com/400x400/?silver,{$keyword}",
               "https://picsum.photos/seed/jewelry{$imageCounter}/400/400"
            ];

            $downloaded = false;

            foreach ($jewelryUrls as $url) {
               try {
                  // Download the image
                  $response = Http::timeout(10)->get($url);

                  if ($response->successful() && strlen($response->body()) > 1000) {
                     // Save the image with the original filename
                     Storage::disk('public')->put($imagePath, $response->body());
                     echo "Created: {$imagePath} from {$keyword}\n";
                     $downloaded = true;
                     break;
                  }
               } catch (\Exception $e) {
                  continue; // Try next URL
               }
            }

            if (!$downloaded) {
               echo "Failed to download jewelry images for: {$imagePath}\n";
            }

            $imageCounter++;

            // Small delay to be respectful to the APIs
            usleep(200000); // 0.2 second

         } catch (\Exception $e) {
            echo "Error creating {$imagePath}: {$e->getMessage()}\n";
         }
      }

      echo "Placeholder image creation completed!\n";
   }
}