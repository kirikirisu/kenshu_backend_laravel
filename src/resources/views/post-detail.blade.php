@component('layout.base-layout')
    <script>
        const url = url('/').
        '/posts/{{ $post->id }}/edit';

        const goPostEditPage = async () => {
            window.location.replace(url);
        }
    </script>
    <label for="title" class="font-bold">title:</label>
    <h2 id="title">{{ $post->title }}</h2>
    <label for="body" class="font-bold">body:</label>
    <p id="body">{{ $post->body }}</p>
    <div class="font-bold">tags</div>
    <div>
        @foreach ($post->tags as $tag)
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $tag->name }}</span>
        @endforeach
    </div>
    <div class="font-bold">images</div>
    <div class="flex">
        @foreach ($post->images as $image)
            <img id={{ $image->id }} alt="image for post" class="w-40 h-40" src='{{ asset($image->url) }}'
                width="20%" />
        @endforeach
    </div>
    <div class="font-bold">user</div>
    <div class="flex items-center">
        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white mr-4" src='{{ asset($post->user->icon_url) }}'
            alt="user avatar">
        <p>{{ $post->user->name }}</p>
    </div>
    @if (Auth::id() === $post->user->id)
        <button onclick="goPostEditPage()">Update Post</button>
        <form method="post" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Post</button>
        </form>
    @endif
@endcomponent
