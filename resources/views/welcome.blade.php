<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food & Drinks Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-5 flex flex-col">
            <h1 class="text-xl font-bold text-red-500">SmartPOS</h1>
            <nav class="mt-5 space-y-3">
                <a href="#" class="flex items-center p-3 bg-yellow-400 rounded-lg font-medium">
                    🍔 Food & Drinks
                </a>
                <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200">📩 Messages</a>
                <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200">💳 Bills</a>
                <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200">⚙️ Settings</a>
            </nav>
            <div class="mt-auto flex items-center space-x-3 p-3 bg-gray-100 rounded-lg">
                <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/100" alt="User">
                <div>
                    <p class="font-semibold">Theresa Webb</p>
                    <span class="text-sm text-gray-500">Open profile</span>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold">Wardank</h2>
                <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
            </div>
            
            <div class="grid grid-cols-3 gap-6 mt-6">
                <!-- Burger Items -->
                <div class="bg-white p-5 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/150" alt="Pop Ice" class="mx-auto mb-4">
                    <h3 class="font-bold">Pop Ice</h3>
                    <p class="text-yellow-500 font-semibold">Rp.4500</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/150" alt="Mie Goreng" class="mx-auto mb-4">
                    <h3 class="font-bold">Mie Goreng</h3>
                    <p class="text-yellow-500 font-semibold">Rp.7000</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/150" alt="Es Kopi" class="mx-auto mb-4">
                    <h3 class="font-bold">EsKopi</h3>
                    <p class="text-yellow-500 font-semibold">Rp.5000</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
