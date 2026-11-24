<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-lg shadow-sm transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
