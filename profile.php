<?php
require_once "config/db.php";
require_once "config/auth.php";
isLoggedIn();

$pageTitle = 'Profile | Social Connector';
$currentPage = 'profile';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main class="ml-20 lg:ml-64 flex-grow p-12 min-h-screen bg-surface">
    <?php if (isset($_SESSION['uid'])) {
        echo "logged";
    } else {
        echo "not logged";
    } ?>
    <!-- Profile Header Section -->
    <section class="mb-16 max-w-6xl mx-auto">
        <div class="flex items-end justify-between gap-8 mb-12">
            <div class="flex items-center gap-8">
                <div
                    class="min-h-28 min-w-28 max-w-32 max-h-32 rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/10">
                    <img alt="Profile Large" class="w-full h-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAxcTv_vCOHUeoArEiFeag5S-jX9G-BV-7iFE-m-_L9033xPWbdZ3CWLh-Zs3pYLWTXhTFKw8i7KdBsrB9Yc5InapsAhQQQIUC8cNZjUuCJGowb243lN1Ppn2hkhviRepRvjQEF8QE3WK-afFeplbrxJ32JlUNfCJ1Rwdzm6qKsyVQ2SLW-TjfWRqvDY9JkQgqR1BtJViHRsoWWExl20Sh8ir4EtQqPEeVyPm2gv4jK7V4UFs24jI7DIQ4BnJy9aeM3zPwZOHL3g" />
                </div>
                <div>
                    <h1 class="font-headline text-5xl font-extrabold tracking-tighter text-on-surface mb-3 flex gap-5">
                        Julian Voss
                        <a href="edit-profile.php"
                            class="material-symbols-outlined hover:text-primary transition-color duration-300 hover:scale-105">
                            edit_square
                        </a>
                    </h1>
                    <p class="text-on-surface-variant font-medium text-lg max-w-xl leading-relaxed">Curating digital
                        spaces for modern intellectuals and high-end design enthusiasts. Based in Berlin.</p>
                </div>
            </div>
        </div>
        <!-- Stats Bento -->
        <div class="grid grid-cols-3 gap-6">
            <div
                class="bg-surface-container p-4 lg:p-8 rounded-xl border border-outline-variant/10 hover:border-primary/20 transition-colors ">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest">Following</span>
                <p class="text-4xl font-headline font-extrabold text-on-surface mt-3">842</p>
            </div>
            <div
                class="bg-surface-container p-4 lg:p-8 rounded-xl border border-outline-variant/10 hover:border-primary/20 transition-colors ">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest">My
                    Community</span>
                <p class="text-4xl font-headline font-extrabold text-on-surface mt-3">3</p>
            </div>
            <div
                class="bg-surface-container p-4 lg:p-8 rounded-xl border border-outline-variant/10 hover:border-primary/20 transition-colors ">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest">Following
                    Community</span>
                <p class="text-4xl font-headline font-extrabold text-on-surface mt-3">124</p>
            </div>
        </div>
    </section>
    <!-- Owned Communities Section -->
    <section class="mb-16 max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="font-headline text-2xl font-bold tracking-tight text-on-surface">Owned Communities</h2>
                <p class="text-on-surface-variant text-sm mt-2">Exclusive circles managed and moderated by you.</p>
            </div>
            <a href="create-community.php"
                class="flex items-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-lg text-sm font-bold hover:opacity-90 transition-all shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-lg">add_circle</span>
                Create New Community
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Community Card 1 -->
            <div
                class="group bg-surface-container rounded-2xl overflow-hidden border border-outline-variant/10 hover:border-primary/30 transition-all duration-300">
                <div class="h-56 overflow-hidden">
                    <img alt="Design Collective"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBdcWmmXZp8OT1PrEIbhN1w0JRop09jd6TgtymZ02n4jf8TcEqhn1YpZk8qT622faR7d0ASavMjQK8qtywpdWUPzAIagxW0spjAEk_PSbijJyerriWLrbU3mj1jR35V0Wzd6VDeLzZVh07_RUdG_hCx26Am3yF63j_p3JQc-fHhENjk_nNSAZyV0YhfmURp7fFMcVPoBfnDY5pROgS1OxW_g4wz18rcK6bKb--8EW-vlfRXnZoxv4DTze2CYEfOGi4gVfGGB2Tggw" />
                </div>
                <div class="p-6">
                    <h3
                        class="font-headline text-xl font-bold text-on-surface mb-3 group-hover:text-primary transition-colors">
                        The Minimalist Collective</h3>
                    <p class="text-on-surface-variant text-sm line-clamp-2 mb-6 leading-relaxed">A high-end circle for
                        architects and industrial designers focusing on Bauhaus principles.</p>
                    <div class="flex items-center justify-between pt-5 border-t border-outline-variant/10">
                        <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">groups</span>
                            <span>2.4k Members</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <span>Berlin, DE</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Community Card 2 -->
            <div
                class="group bg-surface-container rounded-2xl overflow-hidden border border-outline-variant/10 hover:border-primary/30 transition-all duration-300">
                <div class="h-56 overflow-hidden">
                    <img alt="Code Masters"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDYPf6NWhegMq1kUwvBCsiAr7Lyf5ku5Rbxf_oicTGFsY9lW5QmAnGMnaCy398ax_rLQYspSMrn3-5x3T85x_3pRWehRcx6UNp1bvUbr1YsG5VOA3gEHODGsdImo1ZnKCcMa8sNsizKcp8S4hV0-foWQAWL5AvjPcVfFqYW3cET7nITGkgoX8rpoF8lknXzcMOo8o9UtP4pg66AuI0UEcRN5wsHNzafsTP-AKWvqYuANiIuC3Ov6xfz5UHe9ORpxNHSJ6-rxvuQkg" />
                </div>
                <div class="p-6">
                    <h3
                        class="font-headline text-xl font-bold text-on-surface mb-3 group-hover:text-primary transition-colors">
                        Rust Dev Elite</h3>
                    <p class="text-on-surface-variant text-sm line-clamp-2 mb-6 leading-relaxed">Deep dives into systems
                        programming, concurrency, and performance optimization.</p>
                    <div class="flex items-center justify-between pt-5 border-t border-outline-variant/10">
                        <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">groups</span>
                            <span>8.9k Members</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <span>Remote</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Community Card 3 -->
            <div
                class="group bg-surface-container rounded-2xl overflow-hidden border border-outline-variant/10 hover:border-primary/30 transition-all duration-300">
                <div class="h-56 overflow-hidden">
                    <img alt="Mountain Vibes"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAA2Lugy-KSZI1JuSsIsjoKfKQ1h46mfkaeFapeChX6i2CUzEnssdARbzxLayuHozz4I5NrMqv9X7HCLrIt-LHJ99VKYqxEYxGbTsGEx8Riew26rDRQVYYXdJl5OAb7Lbi0fTJ5vgbce4IIo9y9Nxk2Obzvj_avriiK1jkPhoqb_ohpKZg1U937w_H8giBK_fyz9q9tKvCnhpMV7BGXMlOxxm1EA1XuybGEEeDfsyZk7j3skoHWtVNv1-E9zZsta280JMR5Pzhr7g" />
                </div>
                <div class="p-6">
                    <h3
                        class="font-headline text-xl font-bold text-on-surface mb-3 group-hover:text-primary transition-colors">
                        Nocturne Explorers</h3>
                    <p class="text-on-surface-variant text-sm line-clamp-2 mb-6 leading-relaxed">Photography and
                        storytelling from the world's most remote locations at night.</p>
                    <div class="flex items-center justify-between pt-5 border-t border-outline-variant/10">
                        <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">groups</span>
                            <span>512 Members</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <span>Oslo, NO</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>