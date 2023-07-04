<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>
<body  class="mx-auto max-w-4xl">
<header class="mt-5 mb-10">
    <h1 class="text-4xl font-bold">Kenshu backend laravel</h1>
</header>
<main>
    <form action="/user/signup" method="post" enctype="multipart/form-data" class="w-2/5">
        <label for="name" class="block text-base font-semibold"
        >名前</label
        >
        <div class="mt-1">
            <input
                id="name"
                aria-label="name for user"
                type="text"
                name="name"
                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
            />
        </div>
        <div class="mt-6">
            <label for="mail" class="block text-base font-semibold"
            >メールアドレス</label
            >
            <div class="mt-1">
                <input
                    id="mail"
                    aria-label="mail for user"
                    type="text"
                    name="mail"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                />
            </div>
        </div>
        <div class="mt-6">
            <label for="password" class="block text-base font-semibold"
            >パスワード</label
            >
            <div class="mt-1">
                <input
                    id="password"
                    aria-label="password for user"
                    type="text"
                    name="password"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                />
            </div>
        </div>
        <div class="mt-6">
            <label for="avatar[]" class="block text-base font-semibold"
            >プロフィール画像</label
            >
            <div class="mt-1">
                <input
                    id="avatar[]"
                    aria-label="avatar for user"
                    type="file"
                    name="avatar[]"
                    accept="image/*"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                />
            </div>
        </div>
        <button
            type="submit"
            class="mt-5 bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded font-semibold text-white"
        >
            Register
        </button>
    </form>
</main>
</body>
</html>
