<?php
$pageTitle = 'Edit Profile | Social Connector';
$currentPage = 'profile';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Area -->
<main class="ml-20 lg:ml-64 flex-grow min-h-screen bg-background relative">
    <!-- Edit Form Section -->
    <section class="max-w-4xl mx-auto py-12 px-12">
        <div class="mb-12">
            
            <h1 class="text-4xl font-extrabold font-headline text-on-surface tracking-tight mb-2">
                <a href="profile.php" class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-color duration-300">
                    arrow_back_ios
                </a>
                Edit Profile
            </h1>
            <p class="text-on-surface-variant font-medium">Update your presence in the Velvet network.</p>
        </div>
        <!-- Profile Picture Section -->
        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-10 mb-12 p-8 rounded-2xl bg-surface-container-low">
            <div class="relative group">
                <div class="w-32 h-32 rounded-2xl overflow-hidden ring-4 ring-primary/10 shadow-2xl">
                    <img alt="Profile Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDk6owKQ-Wxo50QjJR4vHuLUQfUbXoqsWhZVyfoURVeEu6-6ElkfkusYOHoUZ3As1R_atljLfsU48z9uk3iTIJaTF4hnGDGja_BqXYw7BIzgtfQrmI5mZ78XHIO3lQW67gc5dwJvNSLWs1bNfPWF1K0WC4VMYPO7bEjrJ3y4nQbD1XkCcsoz9P_GhvbH9gGXW1Qu0DaV39sUVnbxcQCGAlDQ9SqKAinlmZ_Piv46PByumY30NxdwxGW_GTBIIkfTqvGyNUwAlHjVw"/>
                </div>
            </div>
            <div class="flex flex-col space-y-4 items-center md:items-start">
                <h3 class="font-headline font-bold text-lg">Profile Avatar</h3>
                <p class="text-on-surface-variant text-sm text-center md:text-left">Use a high-quality portrait for better visibility in the network. Minimum 400x400px.</p>
                <button class="bg-primary/10 text-primary px-6 py-2.5 rounded-xl font-headline font-bold text-sm hover:bg-primary/20 transition-all border border-primary/20 flex items-center space-x-2">
                    <span class="material-symbols-outlined text-lg">add_a_photo</span>
                    <span>Edit Picture</span>
                </button>
            </div>
        </div>
        <!-- Main Fields -->
        <form class="space-y-10">
            <!-- Row 1: Full Name -->
            <div class="space-y-2">
                <label class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Full Name</label>
                <input class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl px-5 py-4 font-medium focus:bg-surface-container-high transition-all" placeholder="Enter your name" type="text" value="Julian Voss"/>
            </div>
            <!-- Row 2: Bio -->
            <div class="space-y-2">
                <label class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Bio</label>
                <textarea class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl px-5 py-4 font-medium focus:bg-surface-container-high transition-all resize-none" placeholder="Tell us about yourself..." rows="4">Digital architect specializing in high-end user experiences and aesthetic systems. Passionate about minimalism, deep-dark interfaces, and the future of social networking.</textarea>
            </div>
            <!-- Row 3: Location & Contact -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Location</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">location_on</span>
                        <input class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl pl-12 pr-5 py-4 font-medium focus:bg-surface-container-high transition-all" type="text" value="London, United Kingdom"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Contact Number</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">call</span>
                        <input class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl pl-12 pr-5 py-4 font-medium focus:bg-surface-container-high transition-all" type="text" value="+44 20 7946 0123"/>
                    </div>
                </div>
            </div>
            <!-- Row 4: DOB & Gender -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Date of Birth</label>
                    <div class="flex space-x-3">
                        <input class="w-20 bg-surface-container-low border-transparent text-on-surface rounded-xl px-4 py-4 text-center font-medium focus:bg-surface-container-high transition-all" placeholder="DD" type="text" value="14"/>
                        <input class="w-20 bg-surface-container-low border-transparent text-on-surface rounded-xl px-4 py-4 text-center font-medium focus:bg-surface-container-high transition-all" placeholder="MM" type="text" value="09"/>
                        <input class="w-20 flex-1 bg-surface-container-low border-transparent text-on-surface rounded-xl px-4 py-4 text-center font-medium focus:bg-surface-container-high transition-all" placeholder="YYYY" type="text" value="1995"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Gender</label>
                    <div class="flex bg-surface-container-low rounded-xl p-1 h-full max-h-[60px]">
                        <label class="flex-1 cursor-pointer">
                            <input checked="" class="sr-only peer" name="gender" type="radio" value="male"/>
                            <div class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">Male</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input class="sr-only peer" name="gender" type="radio" value="female"/>
                            <div class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">Female</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input class="sr-only peer" name="gender" type="radio" value="other"/>
                            <div class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">Other</div>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="pt-10 flex items-center justify-end space-x-6">
                <a herf="profile.php" class="text-on-surface-variant font-headline font-bold text-sm uppercase tracking-widest hover:text-on-surface transition-colors px-6 py-3">
                    Cancel
                </a>
                <button class="bg-gradient-to-br from-primary to-primary-dim text-on-primary-container font-headline font-extrabold text-sm uppercase tracking-widest px-10 py-4 rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all" type="submit">
                    Update Profile
                </button>
            </div>
        </form>
        <!-- Bottom Spacer -->
        <div class="h-24"></div>
    </section>
    <!-- Signature Editorial Grain / Aesthetic Element (Subtle Background Gradient) -->
    <div class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none -z-10"></div>
</main>

<?php include 'includes/footer.php'; ?>
