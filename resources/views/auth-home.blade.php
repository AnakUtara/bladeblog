<x-layout.main title="{{ auth()->user()->username }}'s Feed">
    @if (!$posts->count())
        <section class="grid bg-white dark:bg-gray-900 place-items-center h-[80dvh]">
            <div class="max-w-screen-xl px-4 py-8 text-center lg:py-16">
                <h1
                    class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    Hello {{ auth()->user()->username }}! Welcome to your personal feed!</h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">It
                    seems
                    that your feed is currently empty. Click the button below to get started with your first post. Or
                    you
                    can use our search bar on the navigation menu to search for other people's post & even meet new
                    people
                    with similar interests.</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="/post/create"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Create Post
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @else
        <section class="container mx-auto">
            <div class="py-8">
                <h1
                    class="px-4 mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:px-1 dark:text-white">
                    Latest Posts From People You Follow:</h1>
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <x-ui.post-list :$posts :author="true" />
                    <div>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </section>
    @endif
</x-layout.main>
