@php
    $user = auth()->user();
@endphp

<nav class="sticky top-0 z-20 w-full bg-white border-b border-gray-200 dark:bg-gray-900 start-0 dark:border-gray-600">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl gap-5 p-4 mx-auto lg:gap-10">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <svg class="h-8" id="logo-73" width="100%" height="100%" viewBox="0 0 60 40" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M56.25 1.25C56.25 1.94036 56.8096 2.5 57.5 2.5H58.75C59.4404 2.5 60 1.94036 60 1.25C60 0.559648 59.4404 3.49691e-06 58.75 3.49691e-06H57.5C56.8096 3.49691e-06 56.25 0.559648 56.25 1.25Z"
                    class="ccustom" fill="#212326"></path>
                <path
                    d="M20 40H26.0723L24.3045 38.2322C23.8357 37.7634 23.1998 37.5 22.5368 37.5H20C10.335 37.5 2.5 29.665 2.5 20C2.5 10.335 10.335 2.50001 20 2.5L40 2.5C49.665 2.5 57.5 10.335 57.5 20C57.5 29.665 49.665 37.5 40 37.5H32.5184C31.5238 37.5 30.57 37.1049 29.8667 36.4017L27.7957 34.3306C26.6236 33.1585 25.0338 32.5 23.3762 32.5H20C13.0964 32.5 7.5 26.9036 7.5 20C7.5 13.0964 13.0964 7.5 20 7.5L40 7.5C46.9036 7.5 52.5 13.0964 52.5 20C52.5 26.9036 46.9036 32.5 40 32.5H35.1961C34.2015 32.5 33.2477 32.1049 32.5444 31.4017L30.4733 29.3306C29.3012 28.1585 27.7115 27.5 26.0539 27.5H20C15.8579 27.5 12.5 24.1421 12.5 20C12.5 15.8579 15.8579 12.5 20 12.5L40 12.5C44.1421 12.5 47.5 15.8579 47.5 20C47.5 24.0916 44.2235 27.418 40.1512 27.4985L40.1504 27.5H38.3211C37.3265 27.5 36.3727 27.1049 35.6694 26.4017L33.5983 24.3306C32.6366 23.3688 31.3937 22.7529 30.0628 22.5628L30 22.5L20 22.5C18.6193 22.5 17.5 21.3807 17.5 20C17.5 18.6193 18.6193 17.5 20 17.5L40 17.5C41.3807 17.5 42.5 18.6193 42.5 20C42.5 21.3807 41.3807 22.5 40 22.5H35L36.7678 24.2678C37.2366 24.7366 37.8725 25 38.5355 25H40C42.7614 25 45 22.7614 45 20C45 17.2386 42.7614 15 40 15L20 15C17.2386 15 15 17.2386 15 20C15 22.7614 17.2386 25 20 25L29.1789 25C30.1735 25 31.1273 25.3951 31.8306 26.0983L33.9017 28.1694C35.0738 29.3415 36.6635 30 38.3211 30H40.625V29.9808C45.8567 29.6582 50 25.3129 50 20C50 14.4772 45.5228 10 40 10L20 10C14.4772 10 10 14.4772 10 20C10 25.5229 14.4772 30 20 30H26.0539C27.0485 30 28.0023 30.3951 28.7056 31.0983L30.7767 33.1694C31.9488 34.3415 33.5385 35 35.1961 35H40C48.2843 35 55 28.2843 55 20C55 11.7157 48.2843 5 40 5L20 5C11.7157 5 5 11.7157 5 20C5 28.2843 11.7157 35 20 35H23.3762C24.3708 35 25.3246 35.3951 26.0279 36.0983L28.099 38.1694C29.2711 39.3415 30.8608 40 32.5184 40H40C51.0457 40 60 31.0457 60 20C60 8.9543 51.0457 -9.65645e-07 40 0L20 4.13264e-06C8.9543 5.09829e-06 -9.65645e-07 8.95431 0 20C9.65645e-07 31.0457 8.95431 40 20 40Z"
                    class="ccustom" fill="#212326"></path>
            </svg>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">BladeBlog</span>
        </a>
        @auth
            <!--User Menu-->
            <div x-data="{ results: [], term: '' }" x-effect="results = await liveSearch(term)" class="relative">
                <div class="flex">
                    <div class="relative hidden w-96 max-w-96 md:block">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="text-gray-500 size-4 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search icon</span>
                        </div>
                        <input x-model="term" @change.debounce="term = $event.target.value" type="text"
                            id="search-navbar"
                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg grow ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search...">
                    </div>
                </div>
                <div x-show="term.length" x-transition
                    class="absolute hidden w-full px-4 bg-white border border-gray-200 rounded-lg shadow md:block dark:bg-gray-800 dark:border-gray-700">
                    <div class="flow-root">
                        <ul role="list" class="list-none divide-y divide-gray-200 dark:divide-gray-700">
                            <template x-for="result in results" hidden>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-1 min-w-0 ms-4">
                                            <a :href="'/post/' + result.slug" x-text="result.title"
                                                class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            </a>
                                            <a :href="'/profile/' + result.user.username"
                                                x-text="'| Author: ' + result.user.username"
                                                class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Toggle Mobile Search-->
            <div class="flex items-center space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse">
                <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                    aria-expanded="false"
                    class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    @isset($user->avatar)
                        <img class="rounded-full size-10" src="{{ $user->avatar }}" alt="{{ $user->username }}'s avatar">
                    @else
                        <div class="relative overflow-hidden bg-gray-100 rounded-full size-8 dark:bg-gray-600">
                            <svg class="absolute text-gray-400 size-10 -left-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endisset
                </button>
                <!-- User Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <a href="/profile/{{ $user->username }}"
                            class="block font-bold text-gray-900 text-md dark:text-white">{{ $user->username }}</a>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ $user->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="/post/create"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Create
                                Post</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" data-placement="bottom"
                                class="block px-4 py-2 text-sm text-gray-700 header-chat-icon hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Chat</a>
                        </li>
                        <li>
                            <form method="POST" action="/logout"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                @csrf
                                <button type="submit">Sign
                                    Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div x-data="{ results: [], term: '' }" x-effect="results = await liveSearch(term)"
                class="relative hidden w-full md:hidden" id="navbar-search">
                <div class="items-center justify-between w-full header-search-icon md:flex md:w-auto md:order-1">
                    <div class="relative md:hidden">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input x-model="term" @change.debounce="term = $event.target.value" type="text"
                            id="search-navbar"
                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search...">
                    </div>
                </div>
                <div x-show="term.length" x-transition
                    class="absolute w-full px-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flow-root">
                        <ul role="list" class="list-none divide-y divide-gray-200 dark:divide-gray-700">
                            <template x-for="result in results" hidden>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-1 min-w-0 ms-4">
                                            <a :href="'/post/' + result.slug" x-text="result.title"
                                                class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            </a>
                                            <a :href="'/profile/' + result.user.username"
                                                x-text="'| Author: ' + result.user.username"
                                                class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <x-form.sign-in />
        @endauth
    </div>
</nav>
