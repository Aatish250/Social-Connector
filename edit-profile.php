<?php
require_once "config/db.php";
require_once "config/auth.php";
isLoggedIn();

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
                <a href="profile.php"
                    class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-color duration-300">
                    arrow_back_ios
                </a>
                Edit Profile
            </h1>
            <p class="text-on-surface-variant font-medium">Update your presence in the Velvet network.</p>
        </div>
        <!-- Main Fields -->
        <form class="space-y-10" id="dataForm" enctype="multipart/form-data">

            <!-- Profile Picture Section -->
            <div
                class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-10 mb-12 p-8 rounded-2xl bg-surface-container-low">
                <div class="relative group rounded-2xl overflow-hidden ring-4 ring-primary/10 shadow-2xl flex items-center justify-center"
                    style="width: 150px; height: 150px; min-width: 150px; min-height: 150px;">
                    <img id="profilePicPreview" name="profile_pic" alt="Profile Avatar"
                        class="object-cover w-full h-full"
                        style="width: 100%; height: 100%; min-width: 100px; min-height: 100px; max-width: 200px; max-height: 200px;"
                        src="<?= $user['profile_pic'] ?>"
                        data-original-src="<?= htmlspecialchars($user['profile_pic']) ?>" />
                </div>
                <div class="flex flex-col space-y-4 items-center md:items-start">
                    <h3 class="font-headline font-bold text-lg">Profile Avatar</h3>
                    <p class="text-on-surface-variant text-sm text-center md:text-left">Use a high-quality portrait for
                        better visibility in the network. Minimum 400x400px.</p>
                    <div class="flex flex-row gap-2">
                        <label
                            class="bg-primary/10 text-primary px-6 py-2.5 rounded-xl font-headline font-bold text-sm hover:bg-primary/20 transition-all border border-primary/20 flex items-center space-x-2 cursor-pointer">
                            <span class="material-symbols-outlined text-lg">add_a_photo</span>
                            <span>Edit Picture</span>
                            <input type="file" accept="image/*" name="profile_pic" id="profilePicInput" class="hidden">
                        </label>
                        <button type="button" id="cancelProfilePic"
                            class="bg-error/10 text-error px-4 py-2.5 rounded-xl font-headline font-bold text-sm hover:bg-error/20 transition-all border border-error/20 flex items-center space-x-2"
                            style="display: none;">
                            <span class="material-symbols-outlined text-lg">cancel</span>
                            <span>Cancel</span>
                        </button>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const input = document.getElementById('profilePicInput');
                    const preview = document.getElementById('profilePicPreview');
                    const cancelBtn = document.getElementById('cancelProfilePic');
                    const originalSrc = preview.getAttribute('data-original-src');

                    input.addEventListener('change', function (e) {
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function (ev) {
                                preview.src = ev.target.result;
                                cancelBtn.style.display = "flex";
                            };
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            // User cleared file via dialog
                            preview.src = originalSrc;
                            cancelBtn.style.display = "none";
                        }
                    });

                    cancelBtn.addEventListener('click', function (e) {
                        // Reset preview image to original src
                        preview.src = originalSrc;
                        // Reset input value so the image isn't uploaded
                        input.value = "";
                        // Hide cancel button
                        cancelBtn.style.display = "none";
                    });
                });

                function removeProfilePictureCancelBtn() {
                    const input = document.getElementById('profilePicInput');
                    const cancelBtn = document.getElementById('cancelProfilePic');
                    const preview = document.getElementById('profilePicPreview');
                    
                    input.value = "";
                    cancelBtn.style.display = "none";
                }
            </script>


            <!-- Row 1: Full Name -->
            <div class="space-y-2">
                <label class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Full
                    Name</label>
                <input
                    class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl px-5 py-4 font-medium focus:bg-surface-container-high transition-all"
                    placeholder="Enter your name" type="text" name="fullname" value="<?= $user['fullname'] ?>" />
            </div>

            <!-- Row 2: Bio -->
            <div class="space-y-2">
                <label
                    class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Bio</label>
                <textarea name="bio"
                    class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl px-5 py-4 font-medium focus:bg-surface-container-high transition-all resize-none"
                    placeholder="Tell us about yourself..." rows="4"><?= $user['bio'] ?></textarea>
            </div>

            <!-- Row 3: Location & Contact -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label
                        class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Location</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">location_on</span>
                        <input name="location"
                            class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl pl-12 pr-5 py-4 font-medium focus:bg-surface-container-high transition-all"
                            type="text" value="<?= $user['location'] ?>" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label
                        class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Contact
                        Number</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">call</span>
                        <input name="contact"
                            class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl pl-12 pr-5 py-4 font-medium focus:bg-surface-container-high transition-all"
                            type="text" value="<?= $user['contact'] ?>" />
                    </div>
                </div>
            </div>

            <!-- Row 4: DOB & Gender -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label
                        class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Date
                        of Birth</label>
                    <div>
                        <input
                            class="w-full bg-surface-container-low border-transparent text-on-surface rounded-xl px-5 py-4 font-medium focus:bg-surface-container-high transition-all"
                            type="date" name="dob" value="<?= htmlspecialchars($user['dob']) ?>"
                            placeholder="YYYY-MM-DD" />
                    </div>

                </div>
                <div class="space-y-2">
                    <label
                        class="block text-xs font-headline font-bold uppercase tracking-widest text-primary ml-1">Gender</label>
                    <div class="flex bg-surface-container-low rounded-xl p-1 h-full max-h-[60px]">
                        <label class="flex-1 cursor-pointer">
                            <input class="sr-only peer" name="gender" type="radio" value="male"
                                <?= $user['gender'] == 'male' ? 'checked' : '' ?> />
                            <div
                                class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">
                                Male</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input class="sr-only peer" name="gender" type="radio" value="female"
                                <?= $user['gender'] == 'female' ? 'checked' : '' ?> />
                            <div
                                class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">
                                Female</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input class="sr-only peer" name="gender" type="radio" value="other"
                                <?= $user['gender'] == 'other' ? 'checked' : '' ?> />
                            <div
                                class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">
                                Other</div>
                        </label>
                    </div>

                </div>
            </div>
            <!-- Action Buttons -->
            <div class="pt-10 flex items-center justify-end space-x-6">
                <a href="profile.php"
                    class="text-on-surface-variant cursor-pointer font-headline font-bold text-sm uppercase tracking-widest hover:text-on-surface transition-colors px-6 py-3">Cancel</a>
                <button
                    class="bg-gradient-to-br from-primary to-primary-dim text-on-primary-container font-headline font-extrabold text-sm uppercase tracking-widest px-10 py-4 rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all"
                    type="submit">
                    Update Profile
                </button>
            </div>

        </form>

        <!-- Bottom Spacer -->
        <div class="h-24"></div>
    </section>
    <!-- Signature Editorial Grain / Aesthetic Element (Subtle Background Gradient) -->
    <div
        class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none -z-10">
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    const myForm = document.getElementById('dataForm');

    myForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(myForm);

        fetch('php/update_profile_process.php', {
            method: "POST",
            body: formData
        }).then(response => response.json())
            .then(data => {
                showToast(data.message, data.status, data.timmer);
                if(data.status == 1) removeProfilePictureCancelBtn();
            }).catch(error => {
                showToast('Something went wrong', 0, 5);
            })
    });
</script>