<x-layout.main title="Create New Post">
    <form action="/post" method="POST" class="container w-full px-4 py-8 mx-auto">
        @csrf
        <h1 class="mb-4 text-2xl font-bold">Create New Post</h1>
        <div class="relative mb-6">
            <input type="text" id="floating_outlined" value="{{ old('title') }}" name="title"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="floating_outlined"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Title</label>
            @error('title')
                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                        class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
        <div class="relative mb-6">
            <input id="content" value="{{ old('content') ?? 'Type your content here' }}" type="hidden"
                name="content">
            <trix-editor class="h-56 overflow-y-auto trix-editor md:h-80" input="content"></trix-editor>
            @error('content')
                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                        class="font-medium">{{ $message }}</span></p>
            @enderror
        </div>
        <button type="submit"
            class="w-full px-5 py-5 font-bold text-white bg-gray-800 rounded-lg text-md hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Submit</button>
    </form>
</x-layout.main>
