@props(['status' => 'pending'])

@php
    $normalized = strtolower(trim($status));

    $config = match ($normalized) {
        'pending' => [
            'label' => 'Pending',
            'classes' => 'bg-amber-50 text-amber-800 border-amber-300',
            'dot' => 'bg-[#F59E0B]',
        ],
        'dikonfirmasi' => [
            'label' => 'Dikonfirmasi',
            'classes' => 'bg-blue-50 text-blue-800 border-blue-300',
            'dot' => 'bg-[#2563EB]',
        ],
        'selesai' => [
            'label' => 'Selesai',
            'classes' => 'bg-green-50 text-green-800 border-green-300',
            'dot' => 'bg-[#16A34A]',
        ],
        'ditolak' => [
            'label' => 'Ditolak',
            'classes' => 'bg-red-50 text-red-800 border-red-300',
            'dot' => 'bg-[#DC2626]',
        ],
        default => [
            'label' => ucfirst($status),
            'classes' => 'bg-gray-50 text-gray-800 border-gray-300',
            'dot' => 'bg-gray-400',
        ],
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border ' . $config['classes']]) }}>
    <span class="h-1.5 w-1.5 rounded-full {{ $config['dot'] }}"></span>
    <span>{{ $config['label'] }}</span>
</span>
