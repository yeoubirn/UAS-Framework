<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-accent hover:bg-accent-hover active:bg-amber-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm']) }}>
    {{ $slot }}
</button>
