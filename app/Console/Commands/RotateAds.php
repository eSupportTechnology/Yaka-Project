<?php

namespace App\Console\Commands;
use App\Models\Ads;
use Illuminate\Console\Command;

class RotateAds extends Command
{
    protected $signature = 'ads:rotate';
    protected $description = 'Hourly ad rotation';

    public function handle()
    {
        // Get active ads ordered by package priority and recency
        $ads = Ads::where('status', 1)
            ->orderByRaw('CASE
                WHEN ads_package = 6 THEN 1
                WHEN ads_package = 3 THEN 2
                WHEN ads_package = 4 THEN 3
                WHEN ads_package = 5 THEN 4
                ELSE 5
            END')
            ->orderByDesc('updated_at')
            ->get();
        // Rotate positions only if ads exist
        if ($ads->isNotEmpty()) {
            // Move current first ad to last position
            // $firstAd = $ads->shift();
            // $ads->push($firstAd);

            // Update positions and rotation timestamp
            $position = 0;
            foreach ($ads as $ad) {
                $ad->update([
                    'rotation_position' => $position++,
                    'last_rotated_at' => now()
                ]);
                sleep(2);
            }
        }

        $this->info('Ads rotated successfully.');
    }
}
