<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Situs ini belum dibuka untuk umum. Masukkan kode akses untuk melanjutkan.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('gate.submit') }}">
        @csrf

        <input type="hidden" name="next" value="{{ $next }}">

        <div>
            <x-input-label for="code" value="Kode Akses" />
            <x-text-input id="code" class="block mt-1 w-full" type="password" name="code" required autofocus />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
