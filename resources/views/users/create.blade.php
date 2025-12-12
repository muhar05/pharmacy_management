<!-- filepath: resources/views/users/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Pengguna Baru
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            Lengkapi data pengguna di bawah ini.
        </p>
    </x-slot>

    <main class="mt-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl border border-gray-100 dark:border-gray-700">
                @if ($errors->any())
                    <div class="mx-6 mt-6 mb-2 p-3 rounded bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-200">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.create') }}" class="p-6 space-y-6" id="userForm" novalidate>
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">Nama Lengkap</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}"
                                class="block w-full rounded-md border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500"
                                required maxlength="50" autocomplete="name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                class="block w-full rounded-md border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500"
                                required autocomplete="email">
                        </div>
                        <div>
                            <label for="position" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">Peran</label>
                            <select id="position" name="position" required
                                class="block w-full rounded-md border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled {{ old('position') ? '' : 'selected' }}>Pilih peran</option>
                                <option value="admin" {{ old('position') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pharmacist" {{ old('position') === 'pharmacist' ? 'selected' : '' }}>Apoteker</option>
                                <option value="cashier" {{ old('position') === 'cashier' ? 'selected' : '' }}>Kasir</option>
                                <option value="inventory_manager" {{ old('position') === 'inventory_manager' ? 'selected' : '' }}>Manajer Inventori</option>
                            </select>
                            <div id="role-description" class="mt-2 text-xs text-gray-500 dark:text-gray-400 hidden"></div>
                        </div>
                        <div>
                            <x-input-label for="password" value="Password" class="mb-1" />
                            <div class="relative flex items-center">
                                <x-text-input id="password" name="password" type="password"
                                    class="block w-full pr-16"
                                    required minlength="6" autocomplete="new-password" />
                                <!-- Indikator strength -->
                                <span id="password-strength" class="absolute right-10 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-gray-300"></span>
                                <!-- Icon mata -->
                               
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimal 6 karakter.</p>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('users') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                            Tambah Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Password toggle with eye icon
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');
        togglePassword.onclick = function() {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', !isHidden);
            eyeClosed.classList.toggle('hidden', isHidden);
        };

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const val = this.value;
            const strength = document.getElementById('password-strength');
            let color = 'bg-gray-300';
            if (val.length >= 12 && /[A-Z]/.test(val) && /[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val)) color = 'bg-green-500';
            else if (val.length >= 8 && /[A-Z]/.test(val) && /[0-9]/.test(val)) color = 'bg-blue-500';
            else if (val.length >= 6) color = 'bg-yellow-500';
            else if (val.length > 0) color = 'bg-red-500';
            strength.className = 'absolute right-10 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full ' + color;
        });

        // Role description
        const roleDescriptions = {
            'admin': 'Admin: akses penuh ke semua fitur dan manajemen pengguna.',
            'pharmacist': 'Apoteker: kelola data obat, resep, dan modul farmasi.',
            'cashier': 'Kasir: transaksi penjualan, cetak struk, laporan harian.',
            'inventory_manager': 'Manajer Inventori: kelola stok, pembelian, monitoring inventori.'
        };
        const positionSelect = document.getElementById('position');
        const roleDesc = document.getElementById('role-description');
        positionSelect.addEventListener('change', function() {
            if (roleDescriptions[this.value]) {
                roleDesc.textContent = roleDescriptions[this.value];
                roleDesc.classList.remove('hidden');
            } else {
                roleDesc.classList.add('hidden');
            }
        });
        if (positionSelect.value && roleDescriptions[positionSelect.value]) {
            roleDesc.textContent = roleDescriptions[positionSelect.value];
            roleDesc.classList.remove('hidden');
        }
    </script>
</x-app-layout>