@extends('landing-page.layout')

@section('content')
<div class="blog-page-header">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-8">
            <h1 class="display-4 fw-bold">Blog & Tips</h1>
            <p class="lead">Wawasan terbaru seputar dunia laundry</p>
         </div>
         <div class="col-md-4">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb justify-content-md-end">
                  <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Blog</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</div>

<section class="blog-content-section section-padding">
   <div class="container">
      <div class="row">
         <!-- Main Content - Articles List -->
         <div class="col-lg-8">
            
            <!-- Search Bar Mobile -->
            <div class="d-block d-lg-none mb-4">
                <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                   <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}">
                      <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                   </div>
                </form>
            </div>

            @if($search)
                <div class="alert alert-info mb-4">
                    Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                    <a href="{{ route('blog.index') }}" class="float-end text-decoration-none">Reset</a>
                </div>
            @endif

            <div class="row g-4">
               @forelse($posts as $post)
               <div class="col-md-6">
                  <article class="article-card h-100">
                     <div class="article-image">
                        <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}">
                     </div>
                     <div class="article-content d-flex flex-column h-100">
                        <div class="article-meta">
                           <i class="bi bi-calendar3"></i>
                           <span>{{ $post['date'] }}</span>
                        </div>
                        <h3 class="article-title"><a href="{{ route('blog.show', $post['slug']) }}" class="text-decoration-none text-dark">{{ $post['title'] }}</a></h3>
                        <p class="article-excerpt flex-grow-1">{{ Str::limit($post['excerpt'], 100) }}</p>
                        <a href="{{ route('blog.show', $post['slug']) }}" class="btn-read-more mt-auto">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                     </div>
                  </article>
               </div>
               @empty
               <div class="col-12">
                   <div class="alert alert-warning">
                       Tidak ada artikel yang ditemukan.
                   </div>
               </div>
               @endforelse
            </div>

            <!-- Pagination (Static for now as we use dummy data collection) -->
            <!-- 
            <div class="mt-5">
               {{-- $posts->links() --}}
            </div>
            -->
         </div>

         <!-- Sidebar -->
         <div class="col-lg-4">
            <div class="blog-sidebar ps-lg-4 mt-5 mt-lg-0">
               
               <!-- Search Widget -->
               <div class="sidebar-widget search-widget d-none d-lg-block">
                  <h4 class="widget-title">Pencarian</h4>
                  <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                     <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                     </div>
                  </form>
               </div>

               <!-- Latest Posts Widget -->
               <div class="sidebar-widget latest-posts-widget">
                  <h4 class="widget-title">Postingan Terbaru</h4>
                  <div class="latest-posts-list">
                     @foreach($latestPosts as $latest)
                     <div class="latest-post-item">
                        <div class="latest-post-image">
                           <img src="{{ $latest['image'] }}" alt="{{ $latest['title'] }}">
                        </div>
                        <div class="latest-post-content">
                           <h5><a href="{{ route('blog.show', $latest['slug']) }}">{{ $latest['title'] }}</a></h5>
                           <span class="date">{{ $latest['date'] }}</span>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>

               <!-- Categories Widget (Optional/Static) -->
               <!--
               <div class="sidebar-widget categories-widget">
                  <h4 class="widget-title">Kategori</h4>
                  <ul class="list-unstyled">
                     <li><a href="#">Bisnis Laundry <span>(5)</span></a></li>
                     <li><a href="#">Tips & Trik <span>(3)</span></a></li>
                     <li><a href="#">Perawatan Mesin <span>(2)</span></a></li>
                  </ul>
               </div>
               -->
               
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
