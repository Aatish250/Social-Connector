<?php
$pageTitle = 'Velvet Nocturne | Communities';
$currentPage = 'communities';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Three-Pane Shell -->
<main class="flex-1 flex ml-20 lg:ml-64 h-screen overflow-hidden">
    <!-- Middle Pane: Communities List -->
    <section class="w-24 md:w-96 surface-container-low flex flex-col h-full border-r border-outline-variant/10">
        <div class="p-6">
            <h1 class="-ml-5 md:ml-0 text-sm md:text-2xl font-manrope font-extrabold text-on-surface">Communities</h1>
            <div class="-mx-5 md:mx-0 relative mt-4">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl hidden md:block">search</span>
                <input class="w-full bg-surface-container-high border-none rounded-xl py-2.5 pl-2 md:pl-10 pr-2 md:pr-4 text-sm text-on-surface placeholder:text-on-surface-variant/60 focus:ring-1 focus:ring-primary/40 transition-all" placeholder="Search communities..." type="text"/>
            </div>
        </div>
        <div class="flex-1 overflow-y-auto no-scrollbar px-2 space-y-1 pb-6">
            <!-- Community Items -->
            <!-- Active Item -->
            <div class="p-4 bg-secondary-container rounded-2xl relative flex items-center gap-4 cursor-pointer transition-all duration-300 group">
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-primary rounded-r-full shadow-[0_0_8px_#ac8aff]"></div>
                <div class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center text-on-primary-container overflow-hidden flex-shrink-0">
                    <img alt="Design Community Icon" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB1Hp93LUNvO1kl_a8p3Y_eJZEo2-OXX3UgTusBMMLIzSRDxS1eHtwInKw3GeVK15To3xll9ym8WxP7nFT_t2iBnPoutuKpjOaeAGXJrlwSA3VjRuwqfIZhklG0MzTHlyceeAMn9H-WO4y0ArGeYxArUoo9TBump03l1sn-A0Fd9Agzuidq8K5J9sqTSTeyD68PnYbve-Wb8N_4F0wWwAJp9_l4l9DBpK1jTKgOKxhbs7fuzj4Ffpf1wmnqNPvGvcmhVzYe8j99Sw"/>
                </div>
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-manrope font-bold text-on-surface truncate">Design Community</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">12:45 PM</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-on-surface-variant/30"></span>
                        <p class="text-xs text-on-surface-variant truncate">Alex: Let's review the tokens...</p>
                    </div>
                </div>
            </div>
            <!-- Inactive Items -->
            <div class="p-4 hover:bg-surface-container-high rounded-2xl flex items-center gap-4 cursor-pointer transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center overflow-hidden flex-shrink-0">
                    <img alt="Tech Hub Icon" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlv1K4E_NORjbVpVl6RFsGQHtub0dxVuugh3Zs-6kYNWBqf3tHTtN90xr_jFaGtd9JFQQIwc9Pf8z_3gCHQJwXDGR27K8nZRf3RAVOODG-koNdlKSG1dq7D8yfgmu-9uNjnvlLmFw6d8mLOqM96NVCQJNdvZHpkD_3lcpMdJQsQYEaIszSwuvSiOrN-DBb60FWq7n7MVGkewuvQKM8pdsO1rZF1uWCnHGTZ-SZL1kDonxnCClRmmdWY8jkkPXH52NR3g0xx0Oxkg"/>
                </div>
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-manrope font-bold text-on-surface truncate">Tech Explorers</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Yesterday</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-on-surface-variant/30"></span>
                        <p class="text-xs text-on-surface-variant truncate">Sarah: New GPU benchmarks are in.</p>
                    </div>
                </div>
            </div>
            <div class="p-4 hover:bg-surface-container-high rounded-2xl flex items-center gap-4 cursor-pointer transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center overflow-hidden flex-shrink-0">
                    <img alt="Marketing Masters Icon" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2hVbk4z0d3akGp5XnHVvocATovwN6nEVPgosIenDiQgSJoYcmi-ZMSb-mEHPgBLv7D3_dKFjt3OR82W_P_fitFnSMEsHoHefgGYXH2KzD2sI7ZB9eQZjdm2Wu39ev8s0k9YJb9XHBbyrx6emi7L1Wy0_axXosJ9MBZdOLijBpKkhn7PUvBSgRLf4rAytyuOFTBSrQC_7frpO44wjqXl8-ig8CgGuRP7NAcOulFZJLvGfyDVjTDNY0G0MZZF6XrVKw7RG6GHVhGg"/>
                </div>
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-manrope font-bold text-on-surface truncate">Marketing Masters</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Aug 14</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-on-surface-variant/30"></span>
                        <p class="text-xs text-on-surface-variant truncate">Join the webinar starting in 1h!</p>
                    </div>
                </div>
            </div>
            <div class="p-4 hover:bg-surface-container-high rounded-2xl flex items-center gap-4 cursor-pointer transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center overflow-hidden flex-shrink-0">
                    <img alt="Code Warriors Icon" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAV_G8M8_p6z9g7R1Hnaq7l78GjpzibxmYAIMBEikcI5mN0aEqidwH0JLB1Ob_qSVAAyBvVR1rzpwERRos1xHTBtIP1gMcPjMFxrULwcGIJ6Wi69L3K6Qm1_zmRwk7tKVEx6ziDBwYJhTiVeoHpageFYtOne_QdCfhXTax2kS8hHkofcDfS8Hhq5WuZ8o0C1Bj84Y2td4J_XEHXmpzkaQyEFg2c_urfqFpmjL-488vlInibHzkPxZPzfIf-F_jtTXBS2huHvI9mPA"/>
                </div>
                <div class="flex-1 min-w-0 hidden md:block">
                    <div class="flex justify-between items-baseline mb-0.5">
                        <h3 class="font-manrope font-bold text-on-surface truncate">Code Warriors</h3>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Aug 12</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-on-surface-variant/30"></span>
                        <p class="text-xs text-on-surface-variant truncate">Does anyone have the PR review?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Right Pane: Active Group Chat -->
    <section class="flex-1 bg-surface-variant flex flex-col h-full relative">
        <!-- Chat Header -->
        <header class="h-20 flex items-center px-8 bg-surface-container-low/50 backdrop-blur-md sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center font-bold text-on-primary-container">DC</div>
                <div>
                    <h2 class="font-manrope font-bold text-lg text-on-surface leading-tight">Design Community</h2>
                </div>
            </div>
        </header>

        <!-- Messages Area -->
        <div class="flex-1 overflow-y-auto p-8 flex flex-col gap-8 no-scrollbar">
            <!-- Incoming Message -->
            <div class="flex items-end gap-3 max-w-[80%]">
                <img alt="User Avatar" class="w-8 h-8 rounded-full object-cover flex-shrink-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4r_AbA4Qg0KPY1ThqiZG_ZA1ere4DBqZ9HP_Aw6eMaaBnMRvyzH81N5CYaI3gRN5vMRpf-CCMj1dOq_G1AcxFvFuTeEuJ0AsQHa0g0C6Bcy2uNT0t6A8bAb0LbrbJ7Gp3qd9shzgoQdWqd1rVvHnMAThTTgkoR9KTLGyeFIFW_92pNHelEtrAV49Msfqruvi7WfQrzcwAPmuoTrBiFTUjZno-3byiJP-d_xX8Z8TkU4_fkjoPawYqJLT0hOD2Ajj9nfjxMuH1IA"/>
                <div class="flex flex-col gap-1">
                    <div class="bg-surface-container-high text-on-surface p-4 rounded-t-2xl rounded-br-2xl rounded-bl-sm shadow-sm">
                        <p class="text-sm leading-relaxed"><span class="font-bold mr-1">Elena Rodriguez</span>Hey everyone! Just uploaded the new design system proposal. Would love to get some feedback on the nocturnal theme tokens. 🌙</p>
                    </div>
                    <span class="text-[10px] text-on-surface-variant ml-1">12:40 PM</span>
                </div>
            </div>
            <!-- Outgoing Message -->
            <div class="flex items-end gap-3 max-w-[80%] self-end flex-row-reverse">
                <div class="flex flex-col items-end gap-1">
                    <div class="bg-primary-container text-on-primary-container p-4 rounded-t-2xl rounded-bl-2xl rounded-br-sm shadow-md shadow-primary/5">
                        <p class="text-sm leading-relaxed">Checking it out now Elena! The tonal shifts look incredibly smooth. The purple glow on active states is a nice touch.</p>
                    </div>
                    <div class="flex items-center gap-1 mr-1">
                        <span class="text-[10px] text-on-surface-variant">12:44 PM</span>
                        <span class="material-symbols-outlined text-xs text-primary" style="font-variation-settings: 'FILL' 1;">done_all</span>
                    </div>
                </div>
            </div>
            <!-- Incoming Message -->
            <div class="flex items-end gap-3 max-w-[80%]">
                <img alt="User Avatar" class="w-8 h-8 rounded-full object-cover flex-shrink-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKyBsveQUo4ACDJjRCcOd2zckJkhqqOAJTlDfx89_ZbM3q3ZPtqBMIY3OKKQPjDdiqq_hPO2d1yu0Ln1QNkBp8HNhQTK61us2Vx1s0GtWlZglCtKCirRvyBaU_s4bATSxfDYUMBfRCefCePmBPTGc12LaUGrwdP3TmFOUKAEaWpNHb6TAB7F1etEb2CNg86l6s5GnywMN71MTjeSYtVd87YRUGUxgVHUHenmxLKu5r0i8wJc3_xhIE4C2_v7S23BoC6uZyTQRHIQ"/>
                <div class="flex flex-col gap-1">
                    <div class="bg-surface-container-high text-on-surface p-4 rounded-t-2xl rounded-br-2xl rounded-bl-sm shadow-sm">
                        <p class="text-sm leading-relaxed"><span class="font-bold mr-1">Alex Chen</span>Agreed. I particularly like the "No-Line" rule implementation. It makes the interface feel much more like a high-end physical space.</p>
                    </div>
                    <span class="text-[10px] text-on-surface-variant ml-1">12:45 PM</span>
                </div>
            </div>
        </div>

        <!-- Message Input Bar -->
        <div class="p-6 bg-surface-variant">
            <div class="max-w-4xl mx-auto relative flex items-center gap-3">
                <div class="flex-1 bg-surface-container-highest rounded-2xl flex items-center px-4 py-2 ring-1 ring-primary/30 shadow-[0_0_15px_rgba(172,138,255,0.2)] focus-within:ring-primary/60 transition-all">
                    <input class="flex-1 bg-transparent border-none focus:ring-0 text-on-surface placeholder:text-on-surface-variant py-3" placeholder="Message #Design-Community" type="text"/>
                </div>
                <button class="bg-primary text-on-primary-container w-12 h-12 flex items-center justify-center rounded-xl shadow-lg shadow-primary/10 active:scale-90 transition-transform">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">send</span>
                </button>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
