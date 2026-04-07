<?php
$pageTitle = 'Discover | Social Connector';
$currentPage = 'discover';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Canvas -->
<main class="ml-20 lg:ml-64 min-h-screen pt-16 lg:pt-0">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <!-- Header & Search Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div>
                <h1 class="text-5xl lg:text-6xl font-headline font-black tracking-tight text-on-surface mb-2">Discover</h1>
                <p class="text-on-surface-variant max-w-md text-lg leading-relaxed">Connect with minds that challenge the status quo and push visual boundaries.</p>
            </div>
            <div class="relative w-full md:w-96 group">
                <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input class="w-full bg-surface-container-highest border-none rounded-full py-4 pl-14 pr-6 focus:ring-1 focus:ring-primary text-on-surface placeholder:text-outline transition-all duration-300" placeholder="Search collective..." type="text"/>
            </div>
        </div>
        <!-- Bento Community Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card: Architectural Logic -->
            <div class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img alt="Architectural Logic" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110 opacity-70" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAz6Y-QUsw0Zp3WB1nieg7mi6kU4VOnP4qsXhYfj_njBabK8oU7u-1788odgv5hNUzoAWTTsucD995RlukZxxmIiW9y3468Tx5GWZ0A14EFynY8vztNxkLLvOtgL1Wmv1FpmXdxOItTg3XBfMSiqqC-q-XDbdhicTinuRe0kvyL_fB7r2HlZ4ha_e8VLDP9WzG7-WoFqWCMKYmpXzgu8WdCSj1XtTRUocsX3JL6MaOIsGYR4clppDN_paZgkD-iiMvOO_ckkw3Zzg"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent"></div>
                </div>
                <div class="p-8 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">Architectural Logic</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">Structural philosophy and the intersection of space, weight, and human movement.</p>
                        <div class="flex items-center gap-4 mt-4 mb-6">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">2.4k Members</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">Berlin, DE</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all">Join Community</button>
                </div>
            </div>
            <!-- Card: The Audio Archive -->
            <div class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img alt="The Audio Archive" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110 opacity-70" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIbUcjRv9A-mgJKW1oLx92ecscBTL5OGq_u9g4RKwI6uRtafryTdrUVc5pB1u54QB67tJMsN-AqjaqAux3K64f61Ucjtr3h0qHShsSxevS4MnQZszs1T8b-pwJVIWb7tMc79u8E53pD3HHeMg3ILj_xHtf2Sq9Hoa0w65k-J7-hHGfm2E76ObBq3qEvf8jXheWEqoDvdfmUzydDEJczKawAITHnXfW7TUhNtl-OK2ggmzmD5lvg4FqX2oMIWw8SK0hmLdfrt0vWg"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent"></div>
                </div>
                <div class="p-8 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">The Audio Archive</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">A collective dedicated to sonic texture, obscure field recordings, and minimal synth.</p>
                        <div class="flex items-center gap-4 mt-4 mb-6">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">1.8k Members</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">London, UK</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all">Join Community</button>
                </div>
            </div>
            <!-- Card: Editorial UI -->
            <div class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img alt="Editorial UI" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110 opacity-70" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCvXldPBGVEVnhA-BzV5bsBTwJFSa8rY6HhYyKA4lQvg3rd6salgJii8fJ6DYsUnnC2nuJ6brrsGudJzLziwflOPqOinSR3qnoPb5RhFWgNB00a_JeZUXA6h9P99oNzwk8JpZuxK1NmBea5zPeZ5fB8T6mVQJpSrrmGFFSGd1_PzxFE6Nv5D3xnsRslLB6D7_yKnQ4sNpC6e_v2QFq6O583PY7bPYAuPiKvbz_lCo5GvxU2NYTEXUd7dDtamuCleWb4mIp9gx9HBw"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent"></div>
                </div>
                <div class="p-8 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">Editorial UI</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">Defining the new standard for typography-first interfaces and high-end visual systems.</p>
                        <div class="flex items-center gap-4 mt-4 mb-6">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">3.1k Members</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">New York, US</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all">Join Community</button>
                </div>
            </div>
            <!-- Card: Visual Theory -->
            <div class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img alt="Visual Theory" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110 opacity-70" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3A2PKvpMrxFjKazPIzJZoDAZF4Hh-YtQV2PLUeF4O79CEnCkZ-R8Q0dG0WGQ7duz67KLgNdUS0J2R5nvxaSEdmZg-0wFf7GjlkdHZro280t4Lly8sgoK6LwfSvwMZcvk6NINHz7b0iRczK7lEBjrFiVNIsL5HoI5wHNi737uyTTTVejz-9QADuV7jB5r_0kibkyxKHE1tDpTddNNjzfA2gSChf4K8uvJvGe9q5zzDJulOm1LN7N6gZa7VIwUlrBZeI5Di1jeq3g"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent"></div>
                </div>
                <div class="p-8 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">Visual Theory</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">Analyzing the psychological impact of composition and color in modern media.</p>
                        <div class="flex items-center gap-4 mt-4 mb-6">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">950 Members</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">Tokyo, JP</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all">Join Community</button>
                </div>
            </div>
            <!-- Card: Cyber Ethics -->
            <div class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img alt="Cyber Ethics" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110 opacity-70" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOj71ioYQ8hLLAKXgyMuC18Qi4SsgWfBK9uPZppavgRtdK1xjRttZ1oYD1yLfiDhaJnQXXRcS6_DVerFcFIMP7cfQh1w1Q7gYE_o6AjEd4HFQaCMCsk1GQmQcJcy67naY7Xhfp7cMr8ZD3kldsBdNVPL7mcfcR5YP0T6FoRib_dSYSJBbAOg0Ts_9KKp6KZEMSwtijGK64UKKAm_x6MJif-7sD4BAj1A7v6B-ruYFVpRYgYCFKk9HUVyBT3LvD9rlGSzBua4grgA"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent"></div>
                </div>
                <div class="p-8 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">Cyber Ethics</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">Discussion on the philosophical implications of artificial intelligence and digital autonomy.</p>
                        <div class="flex items-center gap-4 mt-4 mb-6">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">1.2k Members</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">Remote</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all">Join Community</button>
                </div>
            </div>
            <!-- Card: The Foundry -->
            <div class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img alt="The Foundry" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110 opacity-70" src="https://lh3.googleusercontent.com/aida-public/AB6AXuACA23codOCToLXf6hCK28-ghbpMDraMezBvW1C7Lqhn57Dbpk7NYrKw6rhmEqxEVoUVFy03c5LSr462XlkgbJwwSnY3V-dIMHZddKZaxYZbhEt4P0pdhMtLxIUY8esNxJyTNWC6Z0VDaeLFjuKEyJFPLIYrCcLY-Q9mE1AdeOjF-JbFBm-2qVdgyweYyOI6_m25FrwZhHE57whYoBUzbXp-8LT9fLhS0PG4-dTJZpLfcTge2SeDixVowUEk1XGW8jN5Y_3CYEyBQ"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent"></div>
                </div>
                <div class="p-8 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">The Foundry</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">A space for makers, hardware hackers, and those who build with their hands.</p>
                        <div class="flex items-center gap-4 mt-4 mb-6">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">5.7k Members</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">San Francisco, US</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all">Join Community</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
