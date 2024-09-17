<x-layout.main>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
                    Your Daily Dose of Inspiration and Information.</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Discover a world of interesting articles, thought-provoking ideas, and practical advice on a wide
                    range of topics. From current events to personal development, we've got something for everyone.</p>
            </div>
            <form action="/register" method="POST" class="w-full max-w-lg lg:col-span-5">
                @csrf
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Create an account</h2>
                <x-form.ui.v-input-text name="username" label="Name" type="text"
                    placeholder="Enter your username" />
                <x-form.ui.v-input-text type="text" />
                <x-form.ui.v-input-text type="password" name="password" label="Password"
                    placeholder="Enter your password" />
                <x-form.ui.v-input-text type="password" name="password_confirmation" label="Confirm Password"
                    placeholder="Confirm your password" />
                <button type="submit"
                    class="w-full text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Submit</button>
            </form>
        </div>
    </section>
</x-layout.main>
