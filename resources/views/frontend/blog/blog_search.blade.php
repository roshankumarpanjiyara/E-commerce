@forelse ($posts as $post)
    <p>
        <a href="{{route('blog.show',[$post->slug,$post->id])}}">
            {!! Str::limit($post->title,50) !!}
        </a>
    </p>    
@empty
    <p>No data found</p>
@endforelse