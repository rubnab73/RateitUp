<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:active:bg-indigo-700 font-semibold text-sm uppercase tracking-widest rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</button>
