<?php

namespace App\Console\Commands;
use App\Models\Ads;
use Illuminate\Console\Command;
use Carbon\Carbon;

class RotateSuperAds extends Command
{
    protected $signature = 'ads:rotate-super';
    protected $description = 'Hourly ad rotation';

    public function handle()
    {
        // Get active ads ordered by package priority and recency
        $ads = Ads::where('status', 1)
            ->where('ads_package', 6)
            ->where(function ($query) {
                $query->whereNull('package_expire_at')
                      ->orWhere('package_expire_at', '>=', Carbon::now());
            })
            ->orderBy('rotation_position')
            ->get()
            ->values();
        // Rotate positions only if ads exist
        if ($ads->isNotEmpty()) {
            $ads = collect($ads);
            $count = $ads->count();

            // Rotate forward by 1 index each time
            $rotatedAds = $ads->slice(1)->push($ads->first());

            // Update positions and rotation timestamp
            $position = 0;
            foreach ($rotatedAds as $ad) {
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
