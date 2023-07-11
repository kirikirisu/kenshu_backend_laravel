@component('layout.base-layout')
    <form action="/register" method="post" enctype="multipart/form-data" class="w-2/5">
        @csrf
        <div class="mt-6">
            <label for="email" class="block text-base font-semibold">メールアドレス</label>
            <div class="mt-2">
                <input id="email" aria-label="email for user" type="email" name="email" required
                    class="block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500" />
            </div>
        </div>
        <div class="mt-6">
            <label for="password" class="block text-base font-semibold">パスワード</label>
            <div class="mt-2">
                <input id="password" aria-label="password for user" type="text" name="password" required
                    class="block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500" />
            </div>
        </div>
        <button type="submit"
            class="mt-5 bg-sky-500 hover:bg-sky-700 px-5 py-2 text-sm leading-5 rounded font-semibold text-white">
            Login
        </button>
    </form>
@endcomponent
