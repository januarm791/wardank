<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/core@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside x-data="{ open: true }" class="bg-green-700 text-white h-screen p-4 transition-all duration-300 flex flex-col"
        :class="open ? 'w-64' : 'w-20'">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between">
            <h2 x-show="open" class="text-xl font-semibold transition-all duration-300">Warung Sembako</h2>
            <button @click="open = !open" class="p-2 bg-green-800 rounded focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="mt-6 flex-1">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard.admin') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h11M9 21V3m0 0l-7 7m7-7l7 7m-7 0v11"></path>
                        </svg>
                        <span x-show="open">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('barang.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14m1 0a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6a1 1 0 011-1m9-9H6a1 1 0 00-1 1v6a1 1 0 001 1h9m4 0h2">
                            </path>
                        </svg>
                        <span x-show="open">Manajemen Barang</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategori.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h18M9 8h12M3 13h18m-6 5h6"></path>
                        </svg>
                        <span x-show="open">Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pemasok.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h18M9 8h12M3 13h18m-6 5h6"></path>
                        </svg>
                        <span x-show="open">Pemasok</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pembelian.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        <span x-show="open">Pembelian</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('laporan.barang') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2M3 7h18"></path>
                        </svg>
                        <span x-show="open">Laporan Barang</span>
                    </a>
                </li>
                

                <!-- MENU PENGAJUAN BARANG -->
                <li>
                    <a href="{{ route('pelanggan.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-3-3v6m8-9h-4a3 3 0 00-3 3v1H7v-1a3 3 0 00-3-3H1"></path>
                        </svg>
                        <span x-show="open">Pelanggan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M9 17h6M3 17h3m12 0h3"></path>
                        </svg>
                        <span x-show="open">User</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Logout -->
        <div class="mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center p-3 rounded-lg hover:bg-red-600 transition-all w-full text-white">
                    <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-6 bg-white shadow-lg rounded-lg">
        @yield('content')
    </main>

</body>

</html>
