@extends('landing-page.layout')

@section('content')
<div class="blog-page-header">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-12">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $post['title'] }}</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</div>

<section class="blog-detail-section section-padding">
   <div class="container">
      <div class="row">
         <!-- Main Content - Article Detail -->
         <div class="col-lg-8">
            <article class="blog-detail-article">
               <div class="article-header mb-4">
                  <h1 class="article-title fw-bold mb-3">{{ $post['title'] }}</h1>
                  <div class="article-meta d-flex gap-4 text-muted">
                    <div class="meta-item">
                        <i class="bi bi-person-circle text-primary"></i> <span class="ms-1">{{ $post['author'] }}</span>
                    </div>
                     <div class="meta-item">
                        <i class="bi bi-calendar3 text-primary"></i> <span class="ms-1">{{ $post['date'] }}</span>
                     </div>
                  </div>
               </div>

               <div class="article-featured-image mb-4">
                  <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="img-fluid rounded shadow-sm w-100">
               </div>

               <div class="article-body">
                  {!! $post['content'] !!}
               </div>

               <div class="article-footer mt-5 pt-4 border-top">
                   <div class="share-buttons">
                       <span class="me-2 fw-bold">Bagikan:</span>
                       <a href="#" class="btn btn-sm btn-outline-primary rounded-circle"><i class="bi bi-facebook"></i></a>
                       <a href="#" class="btn btn-sm btn-outline-success rounded-circle"><i class="bi bi-whatsapp"></i></a>
                       <a href="#" class="btn btn-sm btn-outline-info rounded-circle"><i class="bi bi-twitter"></i></a>
                   </div>
               </div>
            </article>
         </div>

         <!-- Sidebar -->
         <div class="col-lg-4">
            <div class="blog-sidebar ps-lg-4 mt-5 mt-lg-0">
               
               <!-- Search Widget -->
               <div class="sidebar-widget search-widget">
                  <h4 class="widget-title">Pencarian</h4>
                  <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                     <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari artikel...">
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
               
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
