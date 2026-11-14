@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-surface-border bg-white text-content-primary focus:border-primary focus:ring-primary rounded-md shadow-sm text-sm']) }}>
