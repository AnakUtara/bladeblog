@php
    $postsCount = $posts->count();
    $auth = auth();
@endphp

<x-layout.main title="{{ $user->username }}'s Profile">
    <div class="container w-full px-4 py-8 mx-auto">
        <div class="flex items-center gap-5 mb-2 text-gray-900 dark:text-white">
            <div class="relative overflow-hidden bg-gray-100 rounded-full size-12 dark:bg-gray-600">
                @isset($user->avatar)
                    <img class="size-14" src="{{ $user->avatar }}" alt="{{ $user->username }}'s avatar">
                @else
                    <svg class="absolute text-gray-400 size-14 -left-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                @endisset
            </div>
            <div>
                <a href="/profile/{{ $user->username }}" rel="author"
                    class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->username }}</a>
                <p class="text-base text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
            </div>
            @auth
                <div class="flex items-center">
                    @if ($auth->user()->id == $user->id)
                        <!-- Modal toggle -->
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                            type="button">
                            Change Avatar
                        </button>
                        <!-- Main modal -->
                        <div id="crud-modal" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full p-4">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Change Avatar</h3>
                                        <button type="button"
                                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="crud-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5" action="/avatar" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div x-data="{ src: 'https://placehold.co/120x120?font=roboto' }" class="flex flex-col items-center gap-4 mb-4">
                                            <div>
                                                <img x-bind:src="src" alt="{{ $user->username }}'s Avatar"
                                                    class="object-cover rounded-full size-32 aspect-square">
                                            </div>
                                            <div class="w-full">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                    for="avatar">Upload Avatar</label>
                                                <input name="avatar"
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                    id="avatar" type="file"
                                                    @change="src = URL.createObjectURL($event.target.files[0])">
                                                @error('avatar')
                                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="text-white w-full inline-flex items-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                            <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Upload
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($auth->user()->id != $user->id)
                        <form action="/user/{{ $user->id }}/{{ $isFollowing ? 'unfollow' : 'follow' }}" method="post">
                            @csrf
                            <button type="submit"
                                class="w-full px-5 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">{{ $isFollowing ? 'Unfollow' : 'Follow' }}</button>
                        </form>
                    @endif
                </div>
            @endauth
        </div>
        <!-- Tabs -->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-black hover:text-grey-800 dark:text-white dark:hover:text-grey-500 border-black dark:border-white"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab"
                        aria-controls="profile" aria-selected="false">{{ $postsCount > 1 ? 'Posts' : 'Post' }}
                        {{ $postsCount > 0 ? ": $postsCount" : '' }}</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab"
                        aria-controls="dashboard"
                        aria-selected="false">{{ $followersCount > 1 ? 'Followers' : 'Follower' }}
                        {{ $followersCount > 0 ? ": $followersCount" : '' }}</button>
                </li>
                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab"
                        aria-controls="settings"
                        aria-selected="false">{{ $followingCount > 1 ? 'Following' : 'Following' }}
                        {{ $followingCount > 0 ? ": $followingCount" : '' }}</button>
                </li>
            </ul>
        </div>
        <div id="default-styled-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <!-- Posts -->
                <x-ui.post-list :$posts />
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <x-ui.follow-tab :datas="$followers" access="follower">
                    <x-slot:pagination>
                        {{ $followers->links() }}
                    </x-slot:pagination>
                </x-ui.follow-tab>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <x-ui.follow-tab :datas="$followings" access="following">
                    <x-slot:pagination>
                        {{ $followings->links() }}
                    </x-slot:pagination>
                </x-ui.follow-tab>
            </div>
        </div>
    </div>
</x-layout.main>
