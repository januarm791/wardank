<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@heroicons/react@2/outline"></script>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-blue-700 text-white h-full p-5 transition-all">
            <!-- Header Sidebar -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Kasir POS</h2>
                <button onclick="toggleSidebar()" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard.kasir') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h11M9 21V3m0 0l-7 7m7-7l7 7m-7 0v11" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penjualan.index') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition-all">
                            Transaksi {{ Auth::user()->role }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.penjualan') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition-all">
                            Laporan Penjualan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.uang-masuk') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition-all">
                            Laporan Uang Masuk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengajuan.index') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-green-800 transition-all">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-3-3v6m8-9h-4a3 3 0 00-3 3v1H7v-1a3 3 0 00-3-3H1" />
                            </svg>
                            <span>Pengajuan Barang</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">@yield('header', 'Dashboard Kasir')</h1>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-700">👤 Kasir: {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            let sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-20');
        }
    </script>

</body>

</html>
