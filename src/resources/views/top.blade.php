@component('layout.base-layout')
    <script>
        const fileDragOver = (e) => {
            e.preventDefault()
        }

        const createImageId = (iniNum) => () => {
            return iniNum++
        }
        const count = createImageId(0)

        const fileDrop = (e, type) => {
            e.preventDefault()

            const files = type === "input" ? e.target.files : e.dataTransfer.files
            for (let i = 0; i < files.length; i++) {
                const file = files[i]

                const reader = new FileReader()
                reader.onload = (event) => {
                    const base64Text = event.currentTarget.result

                    document.querySelector('#uploadImageArea').innerHTML +=
                        `<img id="${file.name}-${count()}" alt=${file.name} onclick="onClickImage(event, document)" class="w-40 h-40" src="${base64Text}" width="20%" />`
                }
                reader.readAsDataURL(file)
            }
        }
    </script>
    <form action="/posts" method="post" enctype="multipart/form-data" class="w-2/5">
        @csrf
        <label for="title" class="block text-base font-semibold">タイトル</label>
        <div class="mt-2">
            <input id="title" aria-label="title for post" type="text" name="title"
                class="block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500" />
        </div>
        <div class="mt-6">
            <label for="body" class="block text-base font-semibold">本文</label>
            <div class="mt-2">
                <input id="body" aria-label="body for post" type="text" name="body"
                    class="block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500" />
            </div>
        </div>
        <div class="mt-6">
            <label for="thumbnail" class="block text-base font-semibold">サムネイル</label>
            <input id="thumbnail" type="file" accept="image/*" value="サムネイルを選択" name="thumbnail">
        </div>
        <div class="mt-6">
            <label for="images[]" class="block text-base font-semibold">本文画像</label>
            <div ondrop="fileDrop(event)" ondragover="fileDragOver(event)" class="w-96 h-32 bg-slate-400 mt-4">
                <div class="p-5">
                    ここにドラッグ＆ドロップ
                </div>
            </div>
            <input id="fileInput" multiple type="file" accept="image/*" value="投稿画像を選択" name="images[]"
                onchange="fileDrop(event, 'input')">
        </div>
        <div id="uploadImageArea" class="flex"></div>
        <div class="mt-6">
            <label class="block text-base font-semibold">タグ</label>
            @foreach ($tags as $tag)
                <label><input type="checkbox" name="tags[]" value={{ $tag->id }}>{{ $tag->name }}</label>
            @endforeach
        </div>
        </div>
        <button type="submit"
            class="mt-5 bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded font-semibold text-white">
            Create Post
        </button>
    </form>
    <div>
        @foreach ($posts as $post)
            <ul class="mt-10 grid gap-y-2">
                <div class="max-w-sm w-full lg:max-w-full lg:flex">
                    <div>
                        <img alt="thumbnail" src="http://localhost:8888/storage/{{ $post->thumbnail_url }}"
                            class="w-48 h-48 object-cover" />
                    </div>
                    <a class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal"
                        href="http://localhost:8888/posts/{{ $post->id }}">
                        <div class="mb-8">
                            <div class="text-gray-900 font-bold text-xl mb-2">{{ $post->title }}</div>
                            <p class="text-gray-700 text-base">
                                {{ $post->body }}
                            </p>
                        </div>
                        <div>
                            @foreach ($post->tags as $tag)
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white mr-4"
                                src="http://localhost:8888/storage/{{ $post->user->icon_url }}" alt="">
                            <p>{{ $post->user->name }}</p>
                        </div>
                    </a>
                </div>
            </ul>
        @endforeach
    </div>
@endcomponent
