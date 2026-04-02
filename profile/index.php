<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Social Connector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-shadow { box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05); }
    </style>
</head>
<body class="bg-[#F8FAFB] min-h-screen">

    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-8">
                <div class="flex items-center space-x-2">
                    <div class="bg-[#1A4BFF] p-1.5 rounded-3xl text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
                    </div>
                    <span class="font-bold text-gray-800 text-lg">Social Connector</span>
                </div>
                <div class="relative hidden md:block">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">🔍</span>
                    <input type="text" placeholder="Search" class="bg-gray-100 rounded-full py-1.5 pl-10 pr-4 text-sm w-64 outline-none focus:ring-2 focus:ring-blue-100">
                </div>
            </div>
            <nav class="flex items-center space-x-6 text-sm font-medium text-gray-500">
                <a href="../dashboard" class="hover:text-[#1A4BFF]">Home</a>
                <a href="../discovery" class="hover:text-[#1A4BFF]">Discovery</a>
                <a href="../messages.php" class="hover:text-[#1A4BFF]">Messages</a>
                <div class="flex items-center space-x-3 pl-4 border-l border-gray-200">
                    <button class="text-gray-400">⚙️</button>
                    <img src="https://i.pravatar.cc/150?u=current" class="w-8 h-8 rounded-full border">
                </div>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-8">
        <div class="bg-white rounded-md overflow-hidden custom-shadow mb-8">
            <div class="h-64 bg-gray-200">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover" alt="Cover">
            </div>
            
            <div class="px-10 pb-10">
                <div class="relative flex justify-between items-end -mt-16 mb-6">
                    <div class="p-1 bg-white rounded-full">
                        <img src="https://i.pravatar.cc/150?u=Aatish" class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-sm">
                    </div>
                    <div class="flex space-x-3 mb-2">
                        <button class="px-8 py-2.5 bg-gray-100 text-gray-700 rounded-full font-bold text-sm hover:bg-gray-200 transition">Follow</button>
                        <button class="px-8 py-2.5 bg-[#1A4BFF] text-white rounded-full font-bold text-sm hover:bg-blue-700 transition">Message</button>
                    </div>
                </div>

                <div class="mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-800">Aatish</h1>
                    <p class="text-gray-400 text-sm font-medium mb-4">@aatish • Seattle, WA</p>
                    <p class="text-gray-600 max-w-2xl leading-relaxed">
                        Product Designer & Photography Enthusiast. Exploring the intersection of human behavior and digital interfaces.
                    </p>
                </div>

                <div class="grid grid-cols-3 border-t border-gray-100 pt-8">
                    <div class="text-center">
                        <p class="text-xl font-bold text-gray-800">1.2k</p>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Followers</p>
                    </div>
                    <div class="text-center border-x border-gray-100">
                        <p class="text-xl font-bold text-gray-800">850</p>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Following</p>
                    </div>
                    <div class="text-center">
                        <p class="text-xl font-bold text-gray-800">42</p>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Posts</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white rounded-md p-5 custom-shadow">
                    <h3 class="font-bold text-gray-800 mb-3">Interests</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php 
                        $interests = ['Photography', 'UI Design', 'Hiking', 'Minimalism', 'Travel', 'Coffee'];
                        foreach($interests as $i): ?>
                        <span class="px-4 py-1.5 bg-gray-50 text-gray-500 rounded-full text-xs font-medium hover:bg-blue-50 hover:text-blue-600 cursor-pointer transition">
                            <?= $i ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bg-white rounded-md p-5 custom-shadow">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-bold text-gray-800">Friends</h3>
                        <a href="#" class="text-[#1A4BFF] text-[10px] font-bold uppercase">See All</a>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <?php 
                        $friends = ['Sarah', 'Mike', 'Elena', 'David', 'Jessica', 'Liam'];
                        foreach($friends as $f): ?>
                        <div class="text-center">
                            <img src="https://i.pravatar.cc/150?u=<?= $f ?>" class="w-12 h-12 rounded-full mx-auto mb-2 border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-600"><?= $f ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white rounded-md overflow-hidden custom-shadow">
                    <div class="p-8 pb-0">
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://i.pravatar.cc/150?u=AlexRivers" class="w-10 h-10 rounded-full">
                            <div>
                                <h4 class="text-sm font-bold text-gray-800">Alex Rivers</h4>
                                <p class="text-[10px] text-gray-400">2 hours ago • Seattle</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Just captured this beautiful sunrise over the Puget Sound. There's something magical about the early morning light in the PNW. 🏔️✨
                        </p>
                    </div>
                    <div class="px-4 pb-4">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=1000" class="w-full h-80 object-cover rounded-md" alt="Post image">
                    </div>
                    <div class="px-8 py-6 border-t border-gray-50 flex items-center space-x-8">
                        <button class="flex items-center space-x-2 text-gray-400 text-xs font-bold hover:text-red-500">
                            <span>❤️</span> <span>124</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-400 text-xs font-bold hover:text-blue-500">
                            <span>💬</span> <span>18</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-400 text-xs font-bold">
                            <span>🔗</span> <span>5</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-md p-8 custom-shadow">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="https://i.pravatar.cc/150?u=AlexRivers" class="w-10 h-10 rounded-full">
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Alex Rivers</h4>
                            <p class="text-[10px] text-gray-400">Yesterday • Seattle</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Working on a new design system today. Focusing on accessibility and minimal color palettes. Can't wait to share more soon!
                    </p>
                    <div class="pt-6 border-t border-gray-50 flex items-center space-x-8">
                        <button class="flex items-center space-x-2 text-gray-400 text-xs font-bold"><span>❤️</span> <span>89</span></button>
                        <button class="flex items-center space-x-2 text-gray-400 text-xs font-bold"><span>💬</span> <span>12</span></button>
                        <button class="flex items-center space-x-2 text-gray-400 text-xs font-bold"><span>🔗</span> <span>2</span></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>