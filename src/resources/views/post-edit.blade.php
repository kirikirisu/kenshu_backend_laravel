@component('layout.base-layout')
    <form class="w-2/5" method="post" action="{{ route('posts.update', ['id' => $post->id]) }}">
        @csrf
        @method('PATCH')
        <label for="post-title" class="block text-base font-semibold">タイトル</label>
        <div class="mt-1">
            <input id="title" aria-label="title for post" type="text" name="title"
                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                value={{ $post->title }} />
        </div>
        <div class="mt-6">
            <label for="body" class="block text-base font-semibold">本文</label>
            <div class="mt-1">
                <input id="body" aria-label="body for post" type="text" name="body"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                    value={{ $post->body }} />
            </div>
        </div>
        <button type="submit"
            class="mt-5 bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded font-semibold text-white">
            Update
        </button>
    </form>
@endcomponent
