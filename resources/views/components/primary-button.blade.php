<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-md transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
