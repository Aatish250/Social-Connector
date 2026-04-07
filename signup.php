<?php
$pageTitle = 'Sign Up | Social Connector';
$bodyClass = 'flex min-h-screen items-center justify-center p-6';
include 'includes/header.php';
?>

<!-- Signup Container -->
<main class="w-full max-w-md">
    <!-- Branding Anchor -->
    <div class="flex flex-col items-center mb-10">
        <div class="mb-4">
            <div class="w-16 h-16 signature-gradient rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-on-primary-container text-4xl">hub</span>
            </div>
        </div>
        <h1 class="text-3xl font-black tracking-tighter text-on-surface">Social Connector</h1>
        <p class="text-on-surface-variant font-label text-sm tracking-wide mt-2">Enter the Velvet Nocturne ecosystem</p>
    </div>
    <!-- Form Card -->
    <div class="bg-surface-container-low p-10 rounded-xl editorial-shadow ghost-border backdrop-blur-xl">
        <form class="space-y-6">
            <!-- Full Name Field -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1">Full Name</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">person</span>
                    <input class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border" placeholder="Alex Sterling" type="text"/>
                </div>
            </div>
            <!-- Email Field -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1">Email Address</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">alternate_email</span>
                    <input class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border" placeholder="alex@connector.com" type="email"/>
                </div>
            </div>
            <!-- Password Field -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1">Password</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">lock</span>
                    <input class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border" placeholder="••••••••" type="password"/>
                </div>
            </div>
            <!-- Create Account Button -->
            <button class="w-full signature-gradient text-on-primary-container font-headline font-extrabold text-sm uppercase tracking-widest py-4 rounded-lg shadow-xl shadow-primary/10 active:scale-[0.98] transition-transform duration-200 mt-4" type="submit">
                Create Account
            </button>
        </form>
        <!-- Footer Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-on-surface-variant font-label">
                Already have an account? 
                <a class="text-primary font-bold hover:text-primary-fixed-dim transition-colors ml-1 decoration-primary/30 underline-offset-4 underline" href="login.php">Log in</a>
            </p>
        </div>
    </div>
    <!-- Decorative Subtle Background Element -->
    <div class="fixed top-0 right-0 -z-10 opacity-20">
        <div class="w-[800px] h-[800px] rounded-full blur-[150px] bg-primary/10 translate-x-1/2 -translate-y-1/2"></div>
    </div>
    <div class="fixed bottom-0 left-0 -z-10 opacity-10">
        <div class="w-[600px] h-[600px] rounded-full blur-[120px] bg-tertiary/10 -translate-x-1/2 translate-y-1/2"></div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
