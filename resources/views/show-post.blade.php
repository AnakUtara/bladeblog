<x-layout.main>
    <div class="container w-full px-4 py-8 mx-auto">
        <div class="flex items-center justify-between">
            <h1 class="mb-2 text-4xl font-extrabold ">{{ $post->title }}</h1>
            @can('update', $post)
                <div class="flex gap-1">
                    <button type="button"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                    <x-ui.modal-btn />
                    <x-ui.modal action="/post/{{ $post->id }}" />
                </div>
            @endcan
        </div>
        <div class="flex items-center mb-4 text-xs text-gray-500">Authored by
            <div class="relative mx-1 overflow-hidden bg-gray-100 rounded-full size-7 dark:bg-gray-600">
                <svg class="absolute text-gray-400 size-9 -left-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </div>
            {{ $post->user->username }}, posted
            {{ $post->created_at->diffForHumans() }}
        </div>
        <div class="trix-editor">
            {!! $post->content !!}
        </div>
    </div>
</x-layout.main>
