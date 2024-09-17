@php
    $postsCount = $posts->count();
@endphp


<x-layout.main>
    <div class="container w-full px-4 py-8 mx-auto">
        <div class="flex items-center gap-5 mb-2 text-gray-900 dark:text-white">
            <div class="relative overflow-hidden bg-gray-100 rounded-full size-12 dark:bg-gray-600">
                <svg class="absolute text-gray-400 size-14 -left-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                    </path>
                </svg>
            </div>
            {{-- <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                alt="Jese Leos"> --}}
            <div>
                <a href="/profile/{{ $user->username }}" rel="author"
                    class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->username }}</a>
                <p class="text-base text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
            </div>
        </div>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-black hover:text-grey-800 dark:text-white dark:hover:text-grey-500 border-black dark:border-white"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                        data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">{{ $postsCount > 1 ? 'Posts' : 'Post' }}
                        {{ $postsCount > 0 ? ": $postsCount" : '' }}</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Followers</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab"
                        aria-controls="settings" aria-selected="false">Following</button>
                </li>
            </ul>
        </div>
        <div id="default-styled-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <!-- Posts -->
                @forelse ($posts as $post)
                    <div
                        class="w-full p-6 mb-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="/post/{{ $post->slug }}">
                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $post->title }}</h5>
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Created at
                            {{ $post->created_at->format('l, F j Y') }}</p>
                        <div class="mb-3 overflow-hidden shadow-[inset_0px_-2px_4px_0px_rgb(0,0,0,0.05)] h-44">
                            <div class="trix-editor">
                                {!! $post->content !!}
                            </div>
                        </div>
                        <x-ui.link-btn href="/post/{{ $post->slug }}" />
                        @can('update', $post)
                            <x-ui.link-btn :icon="false" label="Edit" />
                            <x-ui.modal-btn />
                            <x-ui.modal action="/post/{{ $post->id }}" />
                        @endcan
                    </div>
                    <div>
                        {{ $posts->links() }}
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">You haven't made any posts yet...</p>
                @endforelse
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
        </div>
    </div>
</x-layout.main>
