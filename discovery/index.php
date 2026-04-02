<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discovery | Social Connector</title>
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
                <a href="../dashboard" class="hover:text-[#1A4BFF]">Home</a>
                <a href="../discovery" class="text-[#1A4BFF] border-b-2 border-[#1A4BFF] pb-1">Discover</a>
                <a href="../communities" class="hover:text-[#1A4BFF]">Communities</a>
                <a href="../message" class="hover:text-[#1A4BFF]">Messages</a>
            </nav>

            <div class="flex items-center space-x-5">
                <button class="text-gray-400">🔔</button>
                <button class="text-gray-400">⚙️</button>
                <div class="w-10 h-10 bg-[#E6D5C3] rounded-full border-2 border-white shadow-sm overflow-hidden">
                    <img src="https://i.pravatar.cc/150?u=Aatish" alt="Aatish">
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-12">
        <section class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8">Discover your next community</h1>
            
            <div class="max-w-2xl mx-auto relative group">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                    <span class="text-gray-400">🔍</span>
                </div>
                <input type="text" placeholder="Search for people, interests, or communities..." 
                       class="w-full pl-14 pr-32 py-5 bg-white rounded-full custom-shadow outline-none border border-transparent focus:border-blue-100 transition-all text-gray-600">
                <button class="absolute right-3 top-2.5 bottom-2.5 bg-[#1A4BFF] text-white px-8 rounded-full font-bold text-sm hover:bg-blue-700 transition">
                    Search
                </button>
            </div>

            <div class="flex items-center justify-center space-x-3 mt-6 text-xs font-bold uppercase tracking-wider text-gray-400">
                <span>Trending:</span>
                <a href="#" class="text-[#1A4BFF] bg-blue-50 px-3 py-1 rounded-full">#TechConnect</a>
                <a href="#" class="hover:text-gray-600">#Photography</a>
                <a href="#" class="hover:text-gray-600">#HikingGroups</a>
            </div>
        </section>

        <section class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold text-gray-800">Recommended Interests</h2>
                <a href="#" class="text-[#1A4BFF] text-sm font-bold">View All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $communities = [
                    [
                        'title' => 'PHP Development', 
                        'tag' => 'TECH', 
                        'tagColor' => 'blue', 
                        'desc' => '42 mutual interests in your network', 
                        'img' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=facearea&w=400&h=400', 
                        'bg' => 'bg-teal-700', 
                        'btn' => 'Join Community'
                    ],
                    [
                        'title' => 'Hiking', 
                        'tag' => 'OUTDOOR', 
                        'tagColor' => 'green', 
                        'desc' => '12 friends are currently active', 
                        'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=facearea&w=400&h=400',
                        'bg' => 'bg-orange-200',
                        'btn' => 'Follow Topic'
                    ],
                    [
                        'title' => 'UI/UX Design', 
                        'tag' => 'DESIGN', 
                        'tagColor' => 'purple', 
                        'desc' => '90% match with your profile skills', 
                        'img' => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=facearea&w=400&h=400',
                        'bg' => 'bg-gray-800',
                        'btn' => 'Join Community'
                    ],
                    [
                        'title' => 'Specialty Coffee', 
                        'tag' => 'LIFESTYLE', 
                        'tagColor' => 'orange', 
                        'desc' => 'Trending in your current area', 
                        'img' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=facearea&w=400&h=400',
                        'bg' => 'bg-yellow-900',
                        'btn' => 'Follow Topic'
                    ],
                ];

                foreach($communities as $item): ?>
                <div class="bg-white rounded-md overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="h-40 <?= $item['bg'] ?> relative">
                        <img 
                            src="<?= htmlspecialchars($item['img']) ?>" 
                            alt="<?= htmlspecialchars($item['title']) ?>" 
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black opacity-10 group-hover:opacity-0 transition-opacity"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-gray-800 leading-tight"><?= $item['title'] ?></h3>
                            <span class="text-[9px] font-black px-2 py-0.5 rounded bg-<?= $item['tagColor'] ?>-100 text-<?= $item['tagColor'] ?>-600 uppercase tracking-tighter">
                                <?= $item['tag'] ?>
                            </span>
                        </div>
                        <p class="text-[11px] text-gray-400 mb-6"><?= $item['desc'] ?></p>
                        
                        <?php if(str_contains($item['btn'], 'Join')): ?>
                            <button class="w-full bg-[#1A4BFF] text-white py-2.5 rounded-md font-bold text-xs hover:bg-blue-700 transition">
                                <?= $item['btn'] ?>
                            </button>
                        <?php else: ?>
                            <button class="w-full bg-gray-100 text-gray-600 py-2.5 rounded-md font-bold text-xs hover:bg-gray-200 transition">
                                <?= $item['btn'] ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-bold text-gray-800 mb-8">Suggested People to Follow</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $people = [
                    ['name' => 'Alex Rivera', 'role' => 'Fullstack Engineer', 'image' => 'https://i.pravatar.cc/150?u=Alex Rivera'],
                    ['name' => 'Sarah Chen', 'role' => 'Photography Enthusiast', 'image' => 'https://i.pravatar.cc/150?u=Sarah Chen'],
                    ['name' => 'Emma Wilson', 'role' => 'Product Designer', 'image' => 'https://i.pravatar.cc/150?u=Emma Wilson'],
                ];
                foreach($people as $person): ?>
                <div class="bg-white p-4 rounded-md border border-gray-100 flex items-center justify-between custom-shadow">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden">
                            <img src="<?= $person['image'] ?>" alt="<?= $person['name'] ?>">
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm"><?= $person['name'] ?></h4>
                            <p class="text-xs text-gray-400"><?= $person['role'] ?></p>
                        </div>
                    </div>
                    <button class="border border-blue-100 text-[#1A4BFF] px-4 py-1.5 rounded-md text-xs font-bold hover:bg-blue-50 transition">
                        Follow
                    </button>
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