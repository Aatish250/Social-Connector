<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Connector | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-shadow { box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05); }
    </style>
</head>
<body class="bg-[#F0F2F5] min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-12 gap-6">
        
        <aside class="col-span-12 lg:col-span-3">
            <div class="bg-white rounded-md p-6 custom-shadow sticky top-8">
                <div class="flex items-center space-x-3 mb-10 px-2">
                    <div class="bg-blue-600 p-2 rounded-3xl text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-800 leading-tight">Social Connector</h1>
                        <p class="text-xs text-gray-400">Minimalist Networking</p>
                    </div>
                </div>

                <nav class="space-y-1 mb-10">
                    <a href="#" class="flex items-center space-x-4 bg-blue-50 text-blue-600 px-4 py-3 rounded-md font-semibold">
                        <span>🏠</span> <span>Home</span>
                    </a>
                    <a href="../discovery" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition">
                        <span>🧭</span> <span>Discovery</span>
                    </a>
                    <a href="../communities" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition">
                        <span>👥</span> <span>Communities</span>
                    </a>
                    <a href="../message" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition">
                        <span>💬</span> <span>Messages</span>
                    </a>
                    <a href="../profile" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition">
                        <span>👤</span> <span>Profile</span>
                    </a>
                </nav>

                <button class="w-full bg-[#1A4BFF] hover:bg-blue-700 text-white py-4 rounded-md font-bold shadow-lg shadow-blue-200 transition mb-6">
                    + New Post
                </button>

                <a href="#" class="flex items-center space-x-4 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-md transition mt-4 border-t pt-6">
                    <span>⚙️</span> <span>Settings</span>
                </a>
            </div>
        </aside>

        <main class="col-span-12 lg:col-span-6 space-y-6">
            <div class="bg-white rounded-md p-6 custom-shadow">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 aspect-square bg-[#E6D5C3] rounded-full overflow-hidden flex items-center justify-center">
                        <img src="https://i.pravatar.cc/150?u=Aatish" alt="" class="object-cover w-full h-full">
                    </div>
                    <input type="text" placeholder="What's on your mind?" class="bg-transparent text-gray-400 text-lg outline-none w-full">
                </div>
                <div class="flex items-center justify-between border-t pt-4 mt-4">
                    <div class="flex space-x-6">
                        <button class="text-gray-400 hover:text-blue-500">🖼️</button>
                        <button class="text-gray-400 hover:text-blue-500">📹</button>
                        <button class="text-gray-400 hover:text-blue-500">📍</button>
                    </div>
                    <button class="bg-[#1A4BFF] text-white px-8 py-2 rounded-xl font-bold">Post</button>
                </div>
            </div>

            <?php 
                $posts = [
                    ['name' => 'Alex Rivers', 'profile' => 'https://i.pravatar.cc/150?u=Alex Rivers', 'time' => '2 hours ago', 'content' => 'Just finished the new design system for Social Connector. Tailwind-inspired and looking sharp! #UI #Design #WebDev', 'image' => true, 'content_image' => 'https://picsum.photos/400/200'],
                    ['name' => 'Jordan Smith', 'profile' => 'https://i.pravatar.cc/150?u=Jordan Smith', 'time' => '5 hours ago', 'content' => 'Exploring the benefits of minimalist web design in modern SaaS applications. Less is definitely more when it comes to user cognitive load.', 'image' => false, 'content_image' => '']
                ];
                foreach($posts as $post): 
            ?>
            <article class="bg-white rounded-md overflow-hidden custom-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden flex items-center justify-center">
                                <!-- klfdasfjadlks     -->
                                <img src="<?= $post['profile'] ?>" alt="" class="object-cover w-full h-full">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm"><?= $post['name'] ?></h4>
                                <p class="text-xs text-gray-400"><?= $post['time'] ?></p>
                            </div>
                        </div>
                        <button class="text-gray-400 text-xl font-bold">···</button>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4"><?= $post['content'] ?></p>
                </div>
                
                <?php if($post['image']): ?>
                <div class="px-2 pb-2">
                    <div class="bg-[#F8FAFB] border rounded-md h-64 flex items-center justify-center text-gray-300 italic overflow-hidden">
                        <img src="<?= $post['content_image'] ?>" alt="" class="object-cover w-full h-full">
                    </div>
                </div>
                <?php endif; ?>

                <div class="p-6 border-t flex space-x-8 text-gray-400 text-xs font-bold">
                    <button class="flex items-center space-x-2"><span>❤️</span> <span>124</span></button>
                    <button class="flex items-center space-x-2"><span>💬</span> <span>12</span></button>
                    <button class="flex items-center space-x-2"><span>🔗</span> <span>5</span></button>
                </div>
            </article>
            <?php endforeach; ?>
        </main>

        <aside class="col-span-12 lg:col-span-3 space-y-6">
            <div class="bg-white rounded-full flex items-center px-6 py-3 custom-shadow border border-gray-100">
                <span class="mr-3 text-gray-400">🔍</span>
                <input type="text" placeholder="Search Connector" class="bg-transparent outline-none text-sm w-full">
            </div>

            <div class="bg-white rounded-md p-6 custom-shadow">
                <h3 class="font-bold text-gray-800 mb-6">People You May Know</h3>
                <div class="space-y-6">
                    <?php 
                    $people = [
                        ['name' => 'Liam Vance', 'mutual' => 12, 'profile' => 'https://i.pravatar.cc/150?u=Liam Vance'],
                        ['name' => 'Sarah Chen', 'mutual' => 8, 'profile' => 'https://i.pravatar.cc/150?u=Sara Chen'],
                        ['name' => 'David Miller', 'mutual' => 20, 'profile' => 'https://i.pravatar.cc/150?u=David Miller']
                    ]; 
                    foreach($people as $person): ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                                <img src="<?= $person['profile'] ?>" alt="<?= $person['name'] ?>" class="object-cover w-full h-full">
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800"><?= htmlspecialchars($person['name']) ?></h4>
                                <p class="text-[10px] text-gray-400"><?= $person['mutual'] ?> mutual connections</p>
                            </div>
                        </div>
                        <button class="text-[#1A4BFF] bg-blue-50 px-3 py-1 rounded-lg text-[10px] font-bold">Connect</button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="w-full text-center text-blue-600 font-bold text-xs mt-8">Show More</button>
            </div>

            <div class="bg-white rounded-md p-6 custom-shadow">
                <h3 class="font-bold text-gray-800 mb-6">Trending</h3>
                <div class="space-y-4">
                    <?php
                        $trending = [
                            [ 'category' => 'Technology · Trending', 'hashtag' => '#Web3', 'posts' => '12.4K Posts' ],
                            [ 'category' => 'Design · Trending', 'hashtag' => '#Minimalism', 'posts' => '8.1K Posts' ]
                        ];
                        foreach($trending as $value):
                    ?>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider"><?= htmlspecialchars($value['category']) ?></p>
                        <h4 class="font-bold text-gray-800 text-sm"><?= htmlspecialchars($value['hashtag']) ?></h4>
                        <p class="text-[10px] text-gray-400"><?= htmlspecialchars($value['posts']) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="text-[10px] text-gray-400 px-6 space-x-2">
                <span>Privacy</span><span>·</span><span>Terms</span><span>·</span><span>Advertising</span>
                <p class="mt-2 text-center">Connector © 2026</p>
            </div>
        </aside>

    </div>
</div>

</body>
</html>