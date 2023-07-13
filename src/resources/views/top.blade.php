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
        <button type="submit"
            class="mt-5 bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded font-semibold text-white">
            Create Post
        </button>
    </form>
@endcomponent
