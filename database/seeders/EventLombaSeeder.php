<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventLomba;

class EventLombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventLomba::create([
            'nama_lomba' => 'Keamanan Jaringan',
            'deskripsi' => 'Sebuah lomba keamanan jaringan',
            'tempat' => 'GSG',
            'tanggal_pendaftaran' => date('2023-11-3'),
            'tanggal_penutupan_pendaftaran' =>date('2023-11-25'),
            'tanggal_pelaksanaan' =>date('2023-12-4'),
            'kuota' => '50',
            
            
        ]);

    
    }
}
