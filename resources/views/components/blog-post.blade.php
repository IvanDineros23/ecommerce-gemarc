@props(['post', 'featured' => false])

@if($featured)
    <article class="featured-post animate-fade-in">
        <span class="badge badge-featured">Featured</span>
        <h2 class="text-2xl font-bold mt-4 mb-2">{{ $post['title'] }}</h2>
        <div class="blog-meta text-white/80 mb-6">
            <i class="far fa-calendar-alt"></i>
            <span>{{ $post['date'] }}</span>
            <span class="blog-meta-divider">•</span>
            <i class="far fa-user"></i>
            <span>{{ $post['author'] }}</span>
        </div>
        <a href="{{ $post['link'] ?? '#' }}" 
           class="inline-block bg-white text-green-600 px-6 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
            Read More
        </a>
    </article>
@else
    <article class="blog-post animate-fade-in">
        <img src="{{ asset('images/' . $post['image']) }}" 
             alt="{{ $post['title'] }}" 
             class="blog-image">
        <div class="p-6">
            <span class="badge badge-{{ $post['badge_type'] ?? 'tech' }}">
                {{ $post['badge'] }}
            </span>
            <h3 class="text-xl font-bold mt-3 mb-2">{{ $post['title'] }}</h3>
            <div class="blog-meta mb-4">
                <i class="far fa-calendar-alt"></i>
                <span>{{ $post['date'] }}</span>
                <span class="blog-meta-divider">•</span>
                <i class="far fa-user"></i>
                <span>{{ $post['author'] }}</span>
            </div>
            @if(isset($post['excerpt']))
                <p class="text-gray-600 mb-4">{{ $post['excerpt'] }}</p>
            @endif
            <a href="{{ $post['link'] ?? '#' }}" class="read-more">
                Read More →
            </a>
        </div>
    </article>
@endif