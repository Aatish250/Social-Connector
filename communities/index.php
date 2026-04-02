<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communities | Social Connector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-shadow { box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04); }
    </style>
</head>
<body class="bg-[#F8FAFB] min-h-screen">

    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="bg-[#1A4BFF] p-1.5 rounded-3xl text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
                </div>
                <span class="font-bold text-gray-800 text-lg">Social Connector</span>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-gray-500">
                <a href="index.php" class="hover:text-[#1A4BFF]">Home</a>
                <a href="discovery.php" class="hover:text-[#1A4BFF]">Discover</a>
                <a href="communities.php" class="text-[#1A4BFF] border-b-2 border-[#1A4BFF] pb-1">Communities</a>
                <a href="messages.php" class="hover:text-[#1A4BFF]">Messages</a>
            </nav>

            <div class="flex items-center space-x-5">
                <button class="text-gray-400">🔔</button>
                <div class="w-10 h-10 bg-[#E6D5C3] rounded-full border-2 border-white shadow-sm overflow-hidden">
                    <img src="https://i.pravatar.cc/150?u=Aatish" alt="Aatish">
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-12">
        <section class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8">Your tribe is waiting</h1>
            
            <div class="max-w-2xl mx-auto relative group">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                    <span class="text-gray-400">🔍</span>
                </div>
                <input type="text" placeholder="Search for groups, topics, or clubs..." 
                       class="w-full pl-14 pr-32 py-5 bg-white rounded-full custom-shadow outline-none border border-transparent focus:border-blue-100 transition-all text-gray-600">
                <button class="absolute right-3 top-2.5 bottom-2.5 bg-[#1A4BFF] text-white px-8 rounded-full font-bold text-sm hover:bg-blue-700 transition">
                    Find
                </button>
            </div>

            <div class="flex items-center justify-center space-x-3 mt-6 text-xs font-bold uppercase tracking-wider text-gray-400">
                <span>Top Categories:</span>
                <a href="#" class="text-[#1A4BFF] bg-blue-50 px-3 py-1 rounded-full">#StartupLife</a>
                <a href="#" class="hover:text-gray-600">#CreativeDesign</a>
                <a href="#" class="hover:text-gray-600">#AILab</a>
            </div>
        </section>

        <section class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold text-gray-800">Featured Communities</h2>
                <div class="flex space-x-2">
                    <button class="bg-white p-2 rounded-full border border-gray-100 shadow-sm text-xs">←</button>
                    <button class="bg-white p-2 rounded-full border border-gray-100 shadow-sm text-xs">→</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $groups = [
                    [
                        'name' => 'UI Designers Hub', 
                        'tag' => 'DESIGN', 'tagColor' => 'purple', 
                        'members' => '12.8k', 
                        'img' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?auto=format&fit=crop&w=600&q=80',
                        'accent' => 'bg-purple-600'
                    ],
                    [
                        'name' => 'Product Hunters', 
                        'tag' => 'STARTUP', 'tagColor' => 'orange', 
                        'members' => '45.2k', 
                        'img' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80',
                        'accent' => 'bg-orange-500'
                    ],
                    [
                        'name' => 'Fullstack Devs', 
                        'tag' => 'ENGINEERING', 'tagColor' => 'blue', 
                        'members' => '32.1k', 
                        'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80',
                        'accent' => 'bg-blue-600'
                    ],
                ];

                foreach($groups as $g): ?>
                <div class="bg-white rounded-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all group cursor-pointer">
                    <div class="h-48 relative overflow-hidden">
                        <img src="<?= $g['img'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="text-[9px] font-black px-3 py-1 rounded-full bg-white text-gray-800 uppercase tracking-widest shadow-sm">
                                <?= $g['tag'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-extrabold text-gray-800 text-lg mb-1"><?= $g['name'] ?></h3>
                        <div class="flex items-center space-x-2 mb-6">
                            <div class="flex -space-x-2">
                                <img class="w-6 h-6 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?1">
                                <img class="w-6 h-6 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?2">
                                <img class="w-6 h-6 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?3">
                            </div>
                            <span class="text-[11px] text-gray-400 font-medium"><?= $g['members'] ?> members joined</span>
                        </div>
                        <button class="w-full py-3 rounded-md bg-[#1A4BFF] text-white font-bold text-xs hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                            Join Community
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold text-gray-800">Your Communities</h2>
                <button class="bg-[#1A4BFF] text-white px-6 py-2 rounded-full font-bold text-xs hover:bg-blue-700 transition">
                    + Create New
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php
                $myGroups = [
                    ['name' => 'Web3 Pioneers', 'role' => 'Moderator', 'icon' => '🌐', 'color' => 'bg-indigo-50'],
                    ['name' => 'Seattle Hiking Club', 'role' => 'Member', 'icon' => '🏔️', 'color' => 'bg-green-50'],
                ];
                foreach($myGroups as $mg): ?>
                <div class="bg-white p-5 rounded-md border border-gray-100 flex items-center justify-between custom-shadow hover:bg-gray-50 transition cursor-pointer">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 <?= $mg['color'] ?> rounded-xl flex items-center justify-center text-xl">
                            <?= $mg['icon'] ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm"><?= $mg['name'] ?></h4>
                            <p class="text-[10px] text-blue-600 font-bold uppercase tracking-wider"><?= $mg['role'] ?></p>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600 text-lg">⚙️</button>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer class="max-w-6xl mx-auto px-6 py-12 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center text-[11px] text-gray-400 font-medium">
        <div class="flex items-center space-x-2 mb-4 md:mb-0">
            <span>💠 Social Connector © 2024</span>
        </div>
        <div class="flex space-x-6">
            <a href="#" class="hover:text-gray-600 transition">Privacy Policy</a>
            <a href="#" class="hover:text-gray-600 transition">Terms of Service</a>
            <a href="#" class="hover:text-gray-600 transition">Help Center</a>
        </div>
    </footer>

</body>
</html>