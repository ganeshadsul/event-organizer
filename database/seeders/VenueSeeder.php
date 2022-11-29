<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $venueNames = [
			'Asiatic library steps', 'JIO Garden', 'Grease Monkey'
		];
		$venueAddress = [
			'WRJP+P8M, Town Hall, Shahid Bhagat Singh Rd, Fort, Mumbai, Maharashtra 400023',
			'Plot No: RG1A, G Block BKC, Bandra East, Mumbai, Maharashtra 400051',
			'New Link Road, Malad west opp. Goregaon Sports Complex, Mumbai 400064'
		];

		$venueContact = [
			'9876543210',
			'9876543210',
			'9876543210'
		];

		


		for ($i = 0; $i < count($venueNames); $i++){
			Venue::create([
				'name' => $venueNames[$i],
                'address' => $venueAddress[$i],
                'contact_number' => $venueContact[$i]
			]);
		}
    }
}
