<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-transparent border border-primary text-primary hover:bg-primary hover:text-white rounded-md font-semibold text-sm transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
