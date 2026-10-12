<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;
class CategorySeeder extends Seeder {
    public function run(): void {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel, cerpen, dan karya fiksi lainnya'],
            ['name' => 'Sains & Teknologi', 'description' => 'Buku ilmu pengetahuan dan teknologi'],
            ['name' => 'Sejarah & Budaya', 'description' => 'Buku sejarah dan kebudayaan'],
            ['name' => 'Pendidikan', 'description' => 'Buku teks dan referensi pendidikan'],
            ['name' => 'Referensi', 'description' => 'Kamus, ensiklopedia, dan referensi umum'],
        ];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
