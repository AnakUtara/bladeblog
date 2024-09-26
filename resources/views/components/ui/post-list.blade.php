@props([
    'posts' => [],
    'author' => false,
])

@forelse ($posts as $post)
    <div class="w-full p-6 mb-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="/post/{{ $post->slug }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $post->title }}</h5>
        </a>
        @if ($author)
            <div class="flex flex-wrap items-center mb-4 text-xs text-gray-500">Authored by
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
        @else
            <div class="flex items-center mb-4 text-xs text-gray-500">Posted
                {{ $post->created_at->diffForHumans() }}, at {{ $post->created_at->format('l, F j, Y') }}
            </div>
        @endif
        <div class="mb-3 overflow-hidden shadow-[inset_0px_-2px_4px_0px_rgb(0,0,0,0.05)] h-44">
            <div class="trix-editor">
                {!! $post->content !!}
            </div>
        </div>
        <x-ui.link-btn href="/post/{{ $post->slug }}" />
        @can('update', $post)
            <x-ui.link-btn href="/post/{{ $post->slug }}/edit" :icon="false" label="Edit" />
            <x-ui.modal-btn />
            <x-ui.modal action="/post/{{ $post->id }}" />
        @endcan
    </div>
@empty
    <p class="text-sm text-gray-500 dark:text-gray-400">You haven't made any posts yet...</p>
@endforelse
