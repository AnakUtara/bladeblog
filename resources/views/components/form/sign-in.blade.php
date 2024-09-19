<form action="/login" method="POST"
    class="flex flex-col gap-4 space-x-3 grow lg:grow-0 sm:gap-0 sm:flex-row sm:items-center md:order-2 rtl:space-x-reverse">
    @csrf
    <div class="flex items-center w-full gap-2 grow">
        <x-form.ui.h-input-text name="login_email" type="text" placeholder="example@mail.com" label="Email">
            <x-slot:icon>
                <svg class="text-gray-500 size-4 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                </svg>
            </x-slot:icon>
        </x-form.ui.h-input-text>
    </div>
    <div class="flex items-center w-full gap-2 grow">
        <x-form.ui.h-input-text name="login_password" type="password" placeholder="•••••••••" label="Password">
            <x-slot:icon>
                <svg class="text-gray-500 size-4 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17l0 80c0 13.3 10.7 24 24 24l80 0c13.3 0 24-10.7 24-24l0-40 40 0c13.3 0 24-10.7 24-24l0-40 40 0c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z" />
                </svg>
            </x-slot:icon>
        </x-form.ui.h-input-text>
    </div>
    <button type="submit"
        class="text-white text-nowrap w-full md:w-fit bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Sign
        In</button>
</form>
