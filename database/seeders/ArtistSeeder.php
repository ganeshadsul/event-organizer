<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = [
			'Raghu Dixit', 'Nucleya', 'Ritviz', 'Nirali Kartik'
		];

		foreach ( $artists as $artist){
			Artist::create([
                'name' => $artist
            ]);
		}
    }
}
