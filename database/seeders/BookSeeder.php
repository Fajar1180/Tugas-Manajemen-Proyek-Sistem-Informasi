<?php
namespace Database\Seeders;
use App\Models\{Book, Category};
use Illuminate\Database\Seeder;
class BookSeeder extends Seeder {
    public function run(): void {
        $fiksi = Category::where('name','Fiksi')->first();
        $sains = Category::where('name','Sains & Teknologi')->first();
        $sejarah = Category::where('name','Sejarah & Budaya')->first();
        $pendidikan = Category::where('name','Pendidikan')->first();
        $referensi = Category::where('name','Referensi')->first();
        $books = [
            ['isbn'=>'978-602-1234-01-1','title'=>'Laskar Pelangi','author'=>'Andrea Hirata','publisher'=>'Bentang Pustaka','year'=>2005,'category_id'=>$fiksi?->id,'shelf_location'=>'A1','stock'=>5,'description'=>'Novel tentang semangat anak-anak Belitung dalam menggapai mimpi.'],
            ['isbn'=>'978-602-1234-02-2','title'=>'Bumi Manusia','author'=>'Pramoedya Ananta Toer','publisher'=>'Lentera Dipantara','year'=>1980,'category_id'=>$fiksi?->id,'shelf_location'=>'A2','stock'=>3,'description'=>'Novel sejarah tentang perjuangan di era kolonial.'],
            ['isbn'=>'978-602-1234-03-3','title'=>'Fisika Dasar','author'=>'Halliday & Resnick','publisher'=>'Erlangga','year'=>2010,'category_id'=>$sains?->id,'shelf_location'=>'B1','stock'=>8,'description'=>'Buku teks fisika untuk perguruan tinggi.'],
            ['isbn'=>'978-602-1234-04-4','title'=>'Pengantar Ilmu Komputer','author'=>'John C. Brookshear','publisher'=>'Pearson','year'=>2012,'category_id'=>$sains?->id,'shelf_location'=>'B2','stock'=>6,'description'=>'Pengantar ilmu komputer komprehensif.'],
            ['isbn'=>'978-602-1234-05-5','title'=>'Sejarah Indonesia Modern','author'=>'M.C. Ricklefs','publisher'=>'Gadjah Mada University Press','year'=>2008,'category_id'=>$sejarah?->id,'shelf_location'=>'C1','stock'=>4,'description'=>'Sejarah Indonesia dari abad ke-15 hingga masa kini.'],
            ['isbn'=>'978-602-1234-06-6','title'=>'Kebudayaan Sunda','author'=>'Ajip Rosidi','publisher'=>'Kiblat','year'=>2015,'category_id'=>$sejarah?->id,'shelf_location'=>'C2','stock'=>2,'description'=>'Panduan kebudayaan Sunda yang komprehensif.'],
            ['isbn'=>'978-602-1234-07-7','title'=>'Psikologi Pendidikan','author'=>'Oemar Hamalik','publisher'=>'Bumi Aksara','year'=>2014,'category_id'=>$pendidikan?->id,'shelf_location'=>'D1','stock'=>7,'description'=>'Psikologi dalam konteks pendidikan.'],
            ['isbn'=>'978-602-1234-08-8','title'=>'Metodologi Penelitian','author'=>'Sugiyono','publisher'=>'Alfabeta','year'=>2019,'category_id'=>$pendidikan?->id,'shelf_location'=>'D2','stock'=>10,'description'=>'Panduan metodologi penelitian kuantitatif dan kualitatif.'],
            ['isbn'=>'978-602-1234-09-9','title'=>'Kamus Besar Bahasa Indonesia','author'=>'Badan Bahasa','publisher'=>'Balai Pustaka','year'=>2016,'category_id'=>$referensi?->id,'shelf_location'=>'E1','stock'=>3,'description'=>'Kamus resmi bahasa Indonesia.'],
            ['isbn'=>'978-602-1234-10-0','title'=>'Ensiklopedia Sains','author'=>'Tim Penyusun','publisher'=>'Gramedia','year'=>2018,'category_id'=>$referensi?->id,'shelf_location'=>'E2','stock'=>2,'description'=>'Ensiklopedia sains untuk pelajar.'],
        ];
        foreach ($books as $book) {
            Book::firstOrCreate(['isbn' => $book['isbn']], $book);
        }
    }
}
