<?php
$pageTitle = 'Messages | Social Connector';
$currentPage = 'messages';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Area -->
<main class="flex-1 flex h-screen ml-20 lg:ml-64">
    <!-- Middle Pane: Conversation List -->
    <section class="w-24 md:w-96 bg-surface-container-low flex flex-col z-10 border-r border-outline-variant/10">
        <div class="p-6">
            <h1 class="-ml-2 md:ml-0 text-sm md:text-2xl font-headline font-bold text-on-surface mb-2">Messages</h1>
            <div class="-mx-5 md:mx-0 relative mt-4">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl hidden md:block">search</span>
                <input
                    class="w-full bg-surface-container-high border-none rounded-xl py-2.5 pl-2 md:pl-10 pr-2 md:pr-4 text-sm text-on-surface placeholder:text-on-surface-variant/60 focus:ring-1 focus:ring-primary/40 transition-all"
                    placeholder="Search conversations..." type="text" />
            </div>
        </div>
        <div class="flex-1 overflow-y-auto px-2 space-y-1 no-scrollbar w-auto">
            <!-- Conversation Item: Selected -->
            <div
                class="p-4 bg-secondary-container rounded-2xl relative flex items-center gap-4 cursor-pointer transition-all duration-300">
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-primary rounded-r-full shadow-[0_0_8px_#ac8aff]">
                </div>
                <div class="relative">
                    <img alt="Avatar" class="w-12 h-12 rounded-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDz2LbxqfZqyVP0ZugUzOhs2TCs2SjcBwKp7xML0zR5dILWa4LiDRufjH1o79Q67XBZ_nkI7B0x52ls7ryX_lkXidd7QQ7o8fXXb-0n__Bl8uJq-dVtKMST8uf7MVXUBFXEdb_7ShMdOV7kAC2oGOUyYC05Sjte_YZDLOjI6kjAp7-tjj9EhyqvGrt9lg2k_IKDRi8HyJk2ZCkLlJc4zdN9W853s9p-9iAA-9NNaw-kadA6nJgap8qMhRJpuL2EWZtu3bX80Vhc-g" />
                </div>
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-headline font-semibold text-on-surface truncate">Elena Thorne</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">12:45 PM</span>
                    </div>
                    <p class="text-xs text-on-surface-variant truncate">The proposal looks incredible, let's move
                        forward.</p>
                </div>
            </div>
            <!-- Conversation Item -->
            <div
                class="p-4 hover:bg-surface-container-high rounded-2xl flex items-center gap-4 cursor-pointer transition-all duration-300 group">
                <img alt="Avatar" class="w-12 h-12 rounded-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuADgPraxXEBxGySEKVyEZnQl9KXL-v422MfBj3BEzik2qF9V0_o1RNunPEUWHzZTQwa2pHchZHK1sYmLHBdOPKlilZuv3ahDGnue3uah5togYDE3B4zRN3bHkq2-YxZViwpMGOfjgatFoOmWn6_6EVvLSPjVkR3K3yvcqHPIpckW8hR5rs1Gtxm-a6t5OWkzLRktRUK6RvnP-DU1lqCyLyGF-OIdIV31rQLH37Fl4MbSyhhQLlXcArJl3VHCpe8lpQQPI36LC4ipg" />
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-headline font-semibold text-on-surface truncate">Marcus Sterling</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">10:20 AM</span>
                    </div>
                    <p class="text-xs text-on-surface-variant truncate">Are we still meeting at the lounge tonight?</p>
                </div>
            </div>
            <!-- Conversation Item -->
            <div
                class="p-4 hover:bg-surface-container-high rounded-2xl flex items-center gap-4 cursor-pointer transition-all duration-300 group">
                <img alt="Avatar" class="w-12 h-12 rounded-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAVdUX9X7-NbzTeIvirEsiokqW6Jzgw3aAp_1SQSrSrKle3S0SRhptRFxDHWwWijXEibY_YPhFK0XewxicfB1gGYyybs-B79kGnW3SvyB-ogiPX9vzSfkVQDQYbguofaoxv3_FQ7DynnRgQppZqqP_4NEo6aipSCdjTxg8vRvFR9YzkEDynEe0NAXLS4RDYTx7EkHDT6tWmfmW69Rbqupw9bYJndWy7RoS8ox5dzxqQjnZefyQWEtMiVJDNNuj7GKqwzQXMSboh8A" />
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-headline font-semibold text-on-surface truncate">Sloane Reynolds</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Yesterday</span>
                    </div>
                    <p class="text-xs text-on-surface-variant truncate">Let's coordinate on the next phase soon.</p>
                </div>
            </div>
            <!-- Conversation Item -->
            <div
                class="p-4 hover:bg-surface-container-high rounded-2xl flex items-center gap-4 cursor-pointer transition-all duration-300 group">
                <div
                    class="w-12 h-12 rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                    AK</div>
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-headline font-semibold text-on-surface truncate">Adrian Knight</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Tue</span>
                    </div>
                    <p class="text-xs text-on-surface-variant truncate">Thanks for the feedback on the night mode UI.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Right Pane: Chat History -->
    <section class="flex-1 bg-surface-variant flex flex-col relative">
        <!-- Chat Header -->
        <header class="h-20 px-8 flex items-center justify-between bg-surface-container-low/50 backdrop-blur-md z-20">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <img alt="Elena Thorne" class="w-10 h-10 rounded-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCnf-DB8CHv4_5bAojCOcnDLwVnFF_PtKVfcv0RRbxuRdfVqNvsH86LUgHkJiO_SXc7W4Om8UY2ACNkTRiFZwr5aF-Ewe3E_Cxaehvg5qyPpBOBbgWLyVAyWYOaAITTT6auNSHnIgUNHR_hW56SVIyKvIZPCKXpkEl-TGLcOfXAP4edvXqHEfg0J2OfXxnK3ImjKIs-19Hyw0P2gyaYm3fpRnFuHkeGhcI8aU4BeQfwMG23cMPTAMHSJNW-dEhC4GPbNAe0TpYpiQ" />
                </div>
                <div>
                    <h2 class="text-lg font-headline font-bold text-on-surface leading-tight">Elena Thorne</h2>
                </div>
            </div>
        </header>
        <!-- Message Stream -->
        <div class="flex-1 overflow-y-auto p-8 space-y-8 flex flex-col no-scrollbar">
            <!-- Received Message -->
            <div class="flex items-end gap-3 max-w-[80%]">
                <img alt="Elena" class="w-8 h-8 rounded-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmyKDjvsaCkoNYDzJpj4Mx5YHw3M_6rgeDfIlBoafhnnOStQ0zXT9beboDNQvVVk2IagmwubHxqwchwQs4GclrybqZk1nEujpvYz_miLyb3UxDV4uX_0b4zOluagtDtk5ndAcX2MMMW5nxURAHGECmDgLTO9J25xWC3zh0RFmidOdiHwGjZee8Oi56tioS5P18ZwxguxzNmxdwheSR95CeKooEbmTjDpxwDd-77vkKmV3kBCdbELhiItF53OkQjKWOrhL-1oWThQ" />
                <div class="flex flex-col gap-1">
                    <div
                        class="bg-surface-container-high text-on-surface p-4 rounded-t-2xl rounded-br-2xl rounded-bl-sm shadow-sm">
                        <p class="text-sm leading-relaxed">I've just uploaded the final assets for the Velvet Nocturne
                            project. I think the tonal shifts work much better now than the old borders.</p>
                    </div>
                    <span class="text-[10px] text-on-surface-variant ml-1">12:42 PM</span>
                </div>
            </div>
            <!-- Sent Message -->
            <div class="flex items-end gap-3 max-w-[80%] self-end flex-row-reverse">
                <div class="flex flex-col items-end gap-1">
                    <div
                        class="bg-primary-container text-on-primary-container p-4 rounded-t-2xl rounded-bl-2xl rounded-br-sm shadow-md shadow-primary/5">
                        <p class="text-sm leading-relaxed">Agreed. The editorial look is much stronger without those 1px
                            lines. It feels more like a physical space.</p>
                    </div>
                    <div class="flex items-center gap-1 mr-1">
                        <span class="text-[10px] text-on-surface-variant">12:44 PM</span>
                        <span class="material-symbols-outlined text-xs text-primary"
                            style="font-variation-settings: 'FILL' 1;">done_all</span>
                    </div>
                </div>
            </div>
            <!-- Received Message -->
            <div class="flex items-end gap-3 max-w-[80%]">
                <img alt="Elena" class="w-8 h-8 rounded-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoG2ApVMfEWT34TT6Y2tZP-rzB2WAN09LBqm5QFM-jNcb876U-tQdNHH2-Whme9lDsaHx20KZj2KBJgDJhyjylFNVPKsgr94XnmKgii618i7E7G-O1dgp29sICwZJ0zDFP9WhPhvPnA9ZLwLiamoKMNguQZYsohZ4M9Zm5GeaifkitCKIngLyWRftVoyeaIJbkjSYbtHwvk8CDFMZOTI_Nkdn_Zx-QDocDgXNhfnnAVp3LwrD3wYBb_zwPyK6XcKQY6uL53lSeJw" />
                <div class="flex flex-col gap-1">
                    <div
                        class="bg-surface-container-high text-on-surface p-4 rounded-t-2xl rounded-br-2xl rounded-bl-sm">
                        <p class="text-sm">The proposal looks incredible, let's move forward. I'm excited to see how the
                            client reacts to the new aesthetic.</p>
                    </div>
                    <span class="text-[10px] text-on-surface-variant ml-1">12:45 PM</span>
                </div>
            </div>
        </div>
        <!-- Input Area -->
        <div class="p-6 bg-surface-variant">
            <div class="max-w-4xl mx-auto relative flex items-center gap-3">
                <div
                    class="flex-1 bg-surface-container-highest rounded-2xl flex items-center px-4 py-2 ring-1 ring-primary/30 shadow-[0_0_15px_rgba(172,138,255,0.2)] focus-within:ring-primary/60 transition-all">
                    <input
                        class="flex-1 bg-transparent border-none focus:ring-0 text-on-surface placeholder:text-on-surface-variant py-3"
                        placeholder="Type your message..." type="text" />
                </div>
                <button
                    class="bg-gradient-to-br from-primary to-primary-dim text-on-primary-container w-12 h-12 flex items-center justify-center rounded-xl shadow-lg shadow-primary/10 active:scale-90 transition-transform">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">send</span>
                </button>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>