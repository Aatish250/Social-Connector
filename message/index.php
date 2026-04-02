<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | Social Connector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F0F2F5] h-screen flex overflow-hidden">

    <aside class="w-20 lg:w-64 bg-white border-r border-gray-100 flex flex-col items-center lg:items-stretch py-6 px-4">
        <div class="flex items-center space-x-3 mb-10 px-2">
            <div class="bg-[#1A4BFF] p-2 rounded-3xl text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
            </div>
            <div class="hidden lg:block">
                <h1 class="font-bold text-gray-800 leading-tight text-sm">Social Connector</h1>
                <p class="text-[10px] text-gray-400">Modern Networking</p>
            </div>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="../dashboard" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition">
                <span class="text-xl">🏠</span> <span class="hidden lg:block font-medium">Home</span>
            </a>
            <a href="../message" class="flex items-center space-x-4 bg-blue-50 text-[#1A4BFF] px-4 py-3 rounded-md font-bold">
                <span class="text-xl">💬</span> <span class="hidden lg:block">Messages</span>
            </a>
            <a href="../discovery" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition">
                <span>🧭</span> <span>Discovery</span>
            </a>
        </nav>

        <div class="pt-6 border-t border-gray-100 space-y-4">
            <a href="#" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition">
                <span class="text-xl">⚙️</span> <span class="hidden lg:block font-medium">Settings</span>
            </a>
            <div class="flex items-center space-x-3 px-2 py-2">
                <img src="https://i.pravatar.cc/150?u=Aatish" class="w-10 h-10 rounded-full border-2 border-orange-200">
                <div class="hidden lg:block">
                    <p class="text-xs font-bold text-gray-800">Aatish</p>
                    <p class="text-[10px] text-gray-400">aatish.a@dev.com</p>
                </div>
            </div>
        </div>
    </aside>

    <section class="w-80 lg:w-96 bg-white border-r border-gray-100 flex flex-col">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Messages</h2>
                <button class="bg-[#1A4BFF] text-white p-2 rounded-lg shadow-lg shadow-blue-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
            </div>
            <div class="relative mb-6">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">🔍</span>
                <input type="text" placeholder="Search conversations" class="w-full pl-12 pr-4 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-100 outline-none">
            </div>
            <div class="flex space-x-6 text-xs font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100 pb-2">
                <button class="text-[#1A4BFF] border-b-2 border-[#1A4BFF] pb-2">All</button>
                <button class="hover:text-gray-600">Unread</button>
                <button class="hover:text-gray-600">Groups</button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <?php
            $chats = [
                ['name' => 'Sarah Miller', 'msg' => 'See you at 5! I\'ll bring the design specs...', 'time' => '5m ago', 'active' => true, 'unread' => false, 'online' => true],
                ['name' => 'Design Team', 'msg' => 'Updated the assets', 'time' => 'Just now', 'active' => false, 'unread' => true, 'online' => false],
                ['name' => 'Michael Chen', 'msg' => 'The meeting was productive, thanks!', 'time' => '2h ago', 'active' => false, 'unread' => false, 'online' => false],
                ['name' => 'Elena Soroka', 'msg' => 'Can you review the PR?', 'time' => 'Yesterday', 'active' => false, 'unread' => false, 'online' => false]
            ];
            foreach ($chats as $chat): ?>
            <div class="px-4 py-4 flex items-center space-x-4 cursor-pointer hover:bg-gray-50 transition <?= $chat['active'] ? 'bg-blue-50 border-r-4 border-[#1A4BFF]' : '' ?>">
                <div class="relative flex-shrink-0">
                    <img src="https://i.pravatar.cc/150?u=<?= $chat['name'] ?>" class="w-12 h-12 rounded-full object-cover">
                    <?php if($chat['online']): ?>
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                    <?php endif; ?>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-baseline">
                        <h4 class="text-sm font-bold text-gray-800 truncate"><?= $chat['name'] ?></h4>
                        <span class="text-[10px] text-gray-400"><?= $chat['time'] ?></span>
                    </div>
                    <p class="text-xs <?= $chat['unread'] ? 'text-gray-800 font-bold' : 'text-gray-500' ?> truncate mt-1">
                        <?= $chat['msg'] ?>
                    </p>
                </div>
                <?php if($chat['unread']): ?>
                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <main class="flex-1 bg-white flex flex-col">
        <header class="h-20 border-b border-gray-100 flex items-center justify-between px-8">
            <div class="flex items-center space-x-4">
                <img src="https://i.pravatar.cc/150?u=Sarah Miller" class="w-10 h-10 rounded-full">
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Sarah Miller</h3>
                    <p class="text-[10px] text-green-500 flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Online</p>
                </div>
            </div>
            <div class="flex items-center space-x-6 text-gray-400">
                <button class="hover:text-gray-600">📹</button>
                <button class="hover:text-gray-600">📞</button>
                <span class="h-6 border-l border-gray-200"></span>
                <button class="hover:text-gray-600">ℹ️</button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 space-y-8 bg-white custom-scrollbar">
            <div class="flex justify-center">
                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Today</span>
            </div>

            <div class="flex items-end space-x-3 max-w-lg">
                <img src="https://i.pravatar.cc/150?u=Sarah Miller" class="w-8 h-8 rounded-full mb-1">
                <div>
                    <div class="bg-gray-50 text-gray-700 p-4 rounded-2xl rounded-bl-none text-sm leading-relaxed shadow-sm">
                        Hey Alex! Did you get a chance to look at the new interface designs for Social Connector?
                    </div>
                    <span class="text-[10px] text-gray-400 mt-2 block ml-1">10:24 AM</span>
                </div>
            </div>

            <div class="flex items-end justify-end space-x-3">
                <div class="max-w-lg">
                    <div class="bg-[#1A4BFF] text-white p-4 rounded-2xl rounded-br-none text-sm leading-relaxed shadow-lg shadow-blue-100">
                        Not yet, I was just finishing up the backend integration. Give me 10 minutes!
                    </div>
                    <div class="flex items-center justify-end mt-2 space-x-1">
                        <span class="text-[10px] text-gray-400">10:26 AM</span>
                        <span class="text-blue-500 text-[10px]">✓✓</span>
                    </div>
                </div>
            </div>

            <div class="flex items-end space-x-3 max-w-lg">
                <img src="https://i.pravatar.cc/150?u=Sarah Miller" class="w-8 h-8 rounded-full mb-1">
                <div>
                    <div class="bg-gray-50 text-gray-700 p-4 rounded-2xl rounded-bl-none text-sm leading-relaxed shadow-sm">
                        Perfect. No rush. I've uploaded the Figma assets to the design-team channel as well.
                    </div>
                    <span class="text-[10px] text-gray-400 mt-2 block ml-1">10:28 AM</span>
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-50">
            <div class="bg-gray-50 rounded-2xl px-4 py-2 flex items-center space-x-4">
                <button class="text-gray-400 hover:text-gray-600 text-xl">+</button>
                <button class="text-gray-400 hover:text-gray-600 text-xl">🖼️</button>
                <input type="text" placeholder="Type a message..." class="flex-1 bg-transparent border-none outline-none py-3 text-sm text-gray-700">
                <button class="text-gray-400 hover:text-gray-600 text-xl">😊</button>
                <button class="bg-[#1A4BFF] text-white p-2.5 rounded-xl shadow-lg shadow-blue-200">
                    <svg class="w-5 h-5 rotate-90" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </div>
        </div>
    </main>

</body>
</html>