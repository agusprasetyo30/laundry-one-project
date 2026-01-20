<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    private function getDummyPosts()
    {
        return [
            [
                'id' => 1,
                'title' => 'Tips Memulai Bisnis Laundry dari Nol',
                'slug' => 'tips-memulai-bisnis-laundry-dari-nol',
                'excerpt' => 'Panduan lengkap untuk memulai bisnis laundry yang menguntungkan dengan modal minim.',
                'content' => '<p>Memulai bisnis laundry bisa menjadi pilihan yang menjanjikan. Berikut adalah langkah-langkah yang perlu Anda perhatikan:</p><ol><li>Riset Pasar</li><li>Persiapan Modal</li><li>Pemilihan Lokasi</li><li>Pembelian Peralatan</li></ol><p>Dengan perencanaan yang matang, bisnis laundry Anda bisa sukses besar.</p>',
                'image' => 'https://placehold.co/800x450/0d6efd/ffffff?text=Bisnis+Laundry',
                'date' => '15 Des 2025',
                'author' => 'Admin'
            ],
            [
                'id' => 2,
                'title' => 'Cara Merawat Mesin Cuci Agar Awet',
                'slug' => 'cara-merawat-mesin-cuci-agar-awet',
                'excerpt' => 'Tips perawatan mesin cuci industrial agar tetap optimal dan tahan lama.',
                'content' => '<p>Mesin cuci adalah aset utama dalam bisnis laundry. Perawatannya sangat krusial.</p><ul><li>Bersihkan filter secara rutin</li><li>Jangan melebihi kapasitas beban</li><li>Gunakan deterjen yang sesuai</li></ul>',
                'image' => 'https://placehold.co/800x450/0d6efd/ffffff?text=Mesin+Cuci',
                'date' => '10 Des 2025',
                'author' => 'Teknisi'
            ],
            [
                'id' => 3,
                'title' => 'Strategi Marketing untuk Bisnis Laundry',
                'slug' => 'strategi-marketing-untuk-bisnis-laundry',
                'excerpt' => 'Cara efektif memasarkan jasa laundry di era digital untuk menarik lebih banyak pelanggan.',
                'content' => '<p>Pemasaran yang tepat akan mendatangkan pelanggan baru.</p><p>Manfaatkan media sosial, Google Maps, dan promo menarik untuk meningkatkan omzet penjualan jasa laundry Anda.</p>',
                'image' => 'https://placehold.co/800x450/0d6efd/ffffff?text=Marketing',
                'date' => '05 Des 2025',
                'author' => 'Marketing'
            ],
            [
                'id' => 4,
                'title' => 'Peralatan Wajib untuk Usaha Laundry',
                'slug' => 'peralatan-wajib-untuk-usaha-laundry',
                'excerpt' => 'Daftar lengkap peralatan yang harus Anda miliki untuk memulai usaha laundry profesional.',
                'content' => '<p>Berikut adalah check list peralatan wajib:</p><ul><li>Mesin Washer & Dryer</li><li>Setrika Uap</li><li>Meja Setrika</li><li>Timbangan Digital</li><li>Rak Laundry</li></ul>',
                'image' => 'https://placehold.co/800x450/0d6efd/ffffff?text=Peralatan',
                'date' => '01 Des 2025',
                'author' => 'Admin'
            ],
        ];
    }

    public function index(Request $request)
    {
        $posts = collect($this->getDummyPosts());
        $search = $request->input('search');

        if ($search) {
            $posts = $posts->filter(function ($item) use ($search) {
                return false !== stristr($item['title'], $search);
            });
        }

        $latestPosts = collect($this->getDummyPosts())->take(3); // Take top 3 as latest

        return view('landing-page.blog.index', compact('posts', 'latestPosts', 'search'));
    }

    public function show($slug)
    {
        $post = collect($this->getDummyPosts())->firstWhere('slug', $slug);

        if (!$post) {
            abort(404);
        }

        $latestPosts = collect($this->getDummyPosts())->where('slug', '!=', $slug)->take(3);

        return view('landing-page.blog.show', compact('post', 'latestPosts'));
    }
}
