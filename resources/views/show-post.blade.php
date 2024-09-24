<x-layout.main :title="$post->title">
    <div class="container w-full px-4 py-8 mx-auto">
        <div class="flex items-center justify-between">
            <h1 class="mb-2 text-4xl font-extrabold ">{{ $post->title }}</h1>
            @can('update', $post)
                <div class="flex gap-1">
                    <x-ui.link-btn href="/post/{{ $post->slug }}/edit" :icon="false" label="Edit" />
                    <x-ui.modal-btn />
                    <x-ui.modal action="/post/{{ $post->id }}" />
                </div>
            @endcan
        </div>
        <div class="flex items-center mb-4 text-xs text-gray-500">Authored by
            <a href ="/profile/{{ strtolower($post->user->username) }}"
                class="relative mx-1 overflow-hidden bg-gray-100 rounded-full size-7 dark:bg-gray-600">
                @isset($post->user->avatar)
                    <img class="size-9" src="{{ $post->user->avatar }}" alt="{{ $post->user->username }}'s avatar">
                @else
                    <svg class="absolute text-gray-400 size-9 -left-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                @endisset
            </a>
            <a class="font-bold"
                href="/profile/{{ strtolower($post->user->username) }}">{{ $post->user->username }}</a>, posted
            {{ $post->created_at->diffForHumans() }}, at {{ $post->created_at->format('l, F j, Y') }}
        </div>
        <div class="trix-editor">
            {!! $post->content !!}
        </div>
    </div>
</x-layout.main>
