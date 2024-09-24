@props([
    'datas' => [],
    'access' => 'following',
])

<div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flow-root w-full">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($datas as $data)
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <a href="/profile/{{ $data["$access"]->username }}" class="flex-shrink-0">
                            <div class="relative overflow-hidden bg-gray-100 rounded-full size-8 dark:bg-gray-600">
                                @isset($data["$access"]->avatar)
                                    <img class="size-10" src="{{ $data["$access"]->avatar }}"
                                        alt="{{ $data["$access"]->username }}'s Avatar">
                                @else
                                    <svg class="absolute text-gray-400 size-10 -left-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                @endisset
                            </div>
                        </a>
                        <div class="flex-1 min-w-0 ms-4">
                            <a href="/profile/{{ $data["$access"]->username }}"
                                class="text-sm font-bold text-gray-900 truncate dark:text-white">
                                {{ $data["$access"]->username }}
                            </a>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{ $data["$access"]->email }}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">

                        </div>
                    </div>
                </li>
            @empty
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            You haven't followed anyone yet...
                        </p>
                    </div>
                </li>
            @endforelse
        </ul>
        <div>{{ $pagination }}</div>
    </div>
</div>
