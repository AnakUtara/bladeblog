 @props([
     'name' => 'name',
     'type' => 'text',
     'placeholder' => '',
     'label' => 'Email',
 ])

 <label for="{{ $name }}"
     class="block text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
 <div class="flex">
     <span
         class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
         {{ $icon }}
     </span>
     <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
         class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         placeholder="{{ $placeholder }}" />
 </div>
