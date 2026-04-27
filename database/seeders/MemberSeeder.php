<?php
namespace Database\Seeders;
use App\Models\{User, Member};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class MemberSeeder extends Seeder {
    public function run(): void {
        $user = User::firstOrCreate(['email' => 'member@siperpus.test'], [
            'name' => 'Anggota Demo',
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);
        Member::firstOrCreate(['user_id' => $user->id], [
            'nim_nidn' => '2021001',
            'prodi' => 'Teknik Informatika',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh No. 1, Bandung',
        ]);
    }
}
