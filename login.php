<?php
$pageTitle = 'Login | Social Connector';
$bodyClass = 'bg-background text-on-surface font-body min-h-screen flex items-center justify-center selection:bg-primary-container selection:text-on-primary-container';
include 'includes/header.php';
?>

<main class="w-full max-w-md px-6 py-12">
    <!-- Branding Section -->
    <div class="flex flex-col items-center mb-10">
        <div class="mb-4">
            <div class="w-16 h-16 signature-gradient rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-on-primary-container text-4xl">hub</span>
            </div>
        </div>
        <h1 class="font-headline text-4xl font-black tracking-tighter text-on-surface mb-2">
            Social Connector
        </h1>
        <p class="font-body text-on-surface-variant text-sm tracking-wide">
            Welcome back to the velvet nocturne.
        </p>
    </div>
    <!-- Login Form Container -->
    <div class="glass-card ambient-glow rounded-xl p-8 border border-outline-variant/10">
        <form action="communities.php" class="space-y-6" method="POST">
            <!-- Email Input Group -->
            <div class="space-y-2">
                <label class="font-label text-xs font-semibold uppercase tracking-widest text-on-secondary-container" for="email">
                    Email Address
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant group-focus-within:text-primary transition-colors duration-300">
                        <span class="material-symbols-outlined text-xl">alternate_email</span>
                    </div>
                    <input class="block w-full pl-11 pr-4 py-3 bg-surface-container-low border border-outline-variant/20 rounded-lg text-on-surface placeholder:text-on-secondary-fixed-variant/50 focus:ring-1 focus:ring-primary focus:border-primary transition-all duration-300 outline-none" id="email" name="email" placeholder="name@example.com" required="" type="email"/>
                </div>
            </div>
            <!-- Password Input Group -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <label class="font-label text-xs font-semibold uppercase tracking-widest text-on-secondary-container" for="password">
                        Password
                    </label>
                    <a class="text-xs font-medium text-primary hover:text-primary-fixed transition-colors duration-200" href="#">
                        Forgot?
                    </a>
                </div>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant group-focus-within:text-primary transition-colors duration-300">
                        <span class="material-symbols-outlined text-xl">lock</span>
                    </div>
                    <input class="block w-full pl-11 pr-4 py-3 bg-surface-container-low border border-outline-variant/20 rounded-lg text-on-surface placeholder:text-on-secondary-fixed-variant/50 focus:ring-1 focus:ring-primary focus:border-primary transition-all duration-300 outline-none" id="password" name="password" placeholder="••••••••" required="" type="password"/>
                </div>
            </div>
            <!-- Login Button -->
            <button class="w-full primary-gradient text-on-primary-container font-headline font-bold py-3.5 rounded-lg active:scale-95 transition-all duration-200 shadow-lg shadow-primary/10" type="submit">
                Login
            </button>
        </form>
        <!-- Social Login Divider -->
        <div class="relative my-8">
            <div aria-hidden="true" class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-outline-variant/10"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase tracking-widest">
                <span class="bg-[#181825] px-4 text-on-surface-variant">Or continue with</span>
            </div>
        </div>
        <!-- Social Login Actions -->
        <div class="grid grid-cols-2 gap-4">
            <button class="flex items-center justify-center gap-2 px-4 py-2.5 bg-surface-container-high border border-outline-variant/10 rounded-lg hover:bg-surface-variant transition-colors duration-300">
                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">google</span>
                <span class="text-sm font-medium">Google</span>
            </button>
            <button class="flex items-center justify-center gap-2 px-4 py-2.5 bg-surface-container-high border border-outline-variant/10 rounded-lg hover:bg-surface-variant transition-colors duration-300">
                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">ios</span>
                <span class="text-sm font-medium">Apple</span>
            </button>
        </div>
    </div>
    <!-- Footer Link -->
    <p class="mt-8 text-center text-on-surface-variant text-sm">
        Don't have an account? 
        <a class="font-semibold text-primary hover:underline underline-offset-4 decoration-2 decoration-primary/30 transition-all duration-200 ml-1" href="signup.php">
            Sign up
        </a>
    </p>
    <!-- Aesthetic Background Element (Subtle Glow) -->
    <div class="fixed top-0 right-0 -z-10 w-[500px] h-[500px] bg-primary/5 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="fixed bottom-0 left-0 -z-10 w-[400px] h-[400px] bg-tertiary/5 blur-[100px] rounded-full pointer-events-none"></div>
</main>

<?php include 'includes/footer.php'; ?>
