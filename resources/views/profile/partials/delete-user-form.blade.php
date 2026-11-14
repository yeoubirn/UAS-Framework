<section>
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="font-heading font-semibold text-lg text-navy leading-[1.3]">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
            </h2>

            <p class="mt-2 text-sm text-content-secondary leading-relaxed">
                {{ __('Setelah akun dihapus, semua data akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengonfirmasi.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full sm:w-3/4"
                    placeholder="{{ __('Kata sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Hapus akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
