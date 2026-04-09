<?php
$pageTitle = 'Sign Up | Social Connector';
$bodyClass = 'flex min-h-screen items-center justify-center p-6';
include 'includes/header.php';
?>

<!-- Signup Container -->
<main class="w-full max-w-md lg:max-w-4xl">
    <!-- Branding Anchor -->
    <div class="flex flex-col items-center mb-10">
        <div class="mb-4">
            <div
                class="w-16 h-16 signature-gradient rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-on-primary-container text-4xl">hub</span>
            </div>
        </div>
        <h1 class="text-3xl font-black tracking-tighter text-on-surface">Social Connector</h1>
        <p class="text-on-surface-variant font-label text-sm tracking-wide mt-2">Enter the Velvet Nocturne ecosystem</p>
    </div>
    <!-- Form Card -->
    <div class="bg-surface-container-low p-10 rounded-xl editorial-shadow ghost-border backdrop-blur-xl">
        <form class="lg:grid lg:grid-cols-3 gap-4" method="POST" action="php/signup_process.php"
            enctype="multipart/form-data">

            <!-- Profile Picture Field (placeholder and preview) -->
            <div class="space-y-2 lg:row-span-3">
                <div class="relative flex flex-col items-center space-x-4">
                    <!-- Placeholder -->
                    <img id="profilePicPreview" src="https://ui-avatars.com/api/?name=User&background=112&color=999"
                        alt="Profile Preview"
                        class="w-24 h-24 lg:w-40 lg:h-40 rounded-full object-cover border border-outline ml-0" />
                    <!-- File Input Button -->
                    <label for="profile_pic"
                        class="flex items-center cursor-pointer m-2 hover:text-primary transition-color duration-200 hover:bg-surface-container-highest rounded-lg p-2">
                        <span
                            class="material-symbols-outlined text-on-secondary-container text-xl mr-2">photo_camera</span>
                        <span class="text-on-surface-variant text-sm">Choose Image</span>
                    </label>
                    <input name="profile_pic" id="profile_pic" type="file" accept="image/*" class="hidden"
                        onchange="previewProfilePic(event)" />
                </div>
                <script>
                    function previewProfilePic(event) {
                        const [file] = event.target.files;
                        const preview = document.getElementById('profilePicPreview');
                        if (file && file.type.startsWith('image/')) {
                            preview.src = URL.createObjectURL(file);
                        } else {
                            // Reset to placeholder
                            preview.src = 'https://ui-avatars.com/api/?name=User&background=112&color=999';
                        }
                    }
                </script>
            </div>

            <!-- Full Name Field -->
            <div class="space-y-2 lg:col-span-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1"
                    for="fullname">Full Name</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">person</span>
                    <input name="fullname" id="fullname"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border"
                        placeholder="Alex Sterling" type="text" required />
                </div>
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1"
                    for="email">Email Address</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">alternate_email</span>
                    <input name="email" id="email"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border"
                        placeholder="alex@connector.com" type="email" required />
                </div>
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1"
                    for="password">Password</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">lock</span>
                    <input name="password" id="password"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border"
                        placeholder="••••••••" type="password" required minlength="6" />
                </div>
            </div>

            <!-- Location Field (Nepal's Districts) -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1"
                    for="location">Location</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">location_on</span>
                    <select name="location" id="location"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border">
                        <option value="">Select a district...</option>
                        <option value="Achham">Achham</option>
                        <option value="Arghakhanchi">Arghakhanchi</option>
                        <option value="Baglung">Baglung</option>
                        <option value="Baitadi">Baitadi</option>
                        <option value="Bajhang">Bajhang</option>
                        <option value="Bajura">Bajura</option>
                        <option value="Banke">Banke</option>
                        <option value="Bara">Bara</option>
                        <option value="Bardiya">Bardiya</option>
                        <option value="Bhaktapur">Bhaktapur</option>
                        <option value="Bhojpur">Bhojpur</option>
                        <option value="Chitwan">Chitwan</option>
                        <option value="Dadeldhura">Dadeldhura</option>
                        <option value="Dailekh">Dailekh</option>
                        <option value="Dang">Dang</option>
                        <option value="Darchula">Darchula</option>
                        <option value="Dhading">Dhading</option>
                        <option value="Dhankuta">Dhankuta</option>
                        <option value="Dhanusha">Dhanusha</option>
                        <option value="Dolakha">Dolakha</option>
                        <option value="Dolpa">Dolpa</option>
                        <option value="Doti">Doti</option>
                        <option value="Eastern Rukum">Eastern Rukum</option>
                        <option value="Gorkha">Gorkha</option>
                        <option value="Gulmi">Gulmi</option>
                        <option value="Humla">Humla</option>
                        <option value="Ilam">Ilam</option>
                        <option value="Jajarkot">Jajarkot</option>
                        <option value="Jhapa">Jhapa</option>
                        <option value="Jumla">Jumla</option>
                        <option value="Kailali">Kailali</option>
                        <option value="Kalikot">Kalikot</option>
                        <option value="Kanchanpur">Kanchanpur</option>
                        <option value="Kapilvastu">Kapilvastu</option>
                        <option value="Kaski">Kaski</option>
                        <option value="Kathmandu">Kathmandu</option>
                        <option value="Kavrepalanchok">Kavrepalanchok</option>
                        <option value="Khotang">Khotang</option>
                        <option value="Lalitpur">Lalitpur</option>
                        <option value="Lamjung">Lamjung</option>
                        <option value="Mahottari">Mahottari</option>
                        <option value="Makwanpur">Makwanpur</option>
                        <option value="Manang">Manang</option>
                        <option value="Morang">Morang</option>
                        <option value="Mugu">Mugu</option>
                        <option value="Mustang">Mustang</option>
                        <option value="Myagdi">Myagdi</option>
                        <option value="Nawalparasi (Bardaghat Susta East)">Nawalparasi (Bardaghat Susta East)</option>
                        <option value="Nawalparasi (Bardaghat Susta West)">Nawalparasi (Bardaghat Susta West)</option>
                        <option value="Nuwakot">Nuwakot</option>
                        <option value="Okhaldhunga">Okhaldhunga</option>
                        <option value="Palpa">Palpa</option>
                        <option value="Panchthar">Panchthar</option>
                        <option value="Parasi">Parasi</option>
                        <option value="Parbat">Parbat</option>
                        <option value="Parsa">Parsa</option>
                        <option value="Pyuthan">Pyuthan</option>
                        <option value="Ramechhap">Ramechhap</option>
                        <option value="Rasuwa">Rasuwa</option>
                        <option value="Rautahat">Rautahat</option>
                        <option value="Rolpa">Rolpa</option>
                        <option value="Rupandehi">Rupandehi</option>
                        <option value="Salyan">Salyan</option>
                        <option value="Sankhuwasabha">Sankhuwasabha</option>
                        <option value="Saptari">Saptari</option>
                        <option value="Sarlahi">Sarlahi</option>
                        <option value="Sindhuli">Sindhuli</option>
                        <option value="Sindhupalchok">Sindhupalchok</option>
                        <option value="Siraha">Siraha</option>
                        <option value="Solukhumbu">Solukhumbu</option>
                        <option value="Sunsari">Sunsari</option>
                        <option value="Surkhet">Surkhet</option>
                        <option value="Syangja">Syangja</option>
                        <option value="Tanahun">Tanahun</option>
                        <option value="Taplejung">Taplejung</option>
                        <option value="Tehrathum">Tehrathum</option>
                        <option value="Udayapur">Udayapur</option>
                    </select>
                </div>
            </div>

            <!-- Contact Field -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1"
                    for="contact">Contact</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">call</span>
                    <input name="contact" id="contact"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border"
                        placeholder="Phone number (optional)" type="text" />
                </div>
            </div>

            <!-- Date of Birth Field -->
            <div class="space-y-2">
                <label class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1"
                    for="dob">Date of Birth</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-secondary-container text-xl">calendar_month</span>
                    <input name="dob" id="dob"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all outline-none ghost-border"
                        type="date" />
                </div>
            </div>

            <!-- Gender Field as Radio Buttons -->
            <div class="space-y-2">
                <label
                    class="block text-xs font-bold tracking-widest text-on-surface-variant uppercase ml-1">Gender</label>
                <div class="flex bg-surface-container-low rounded-xl p-1 h-[54px]">
                    <label class="flex-1 cursor-pointer">
                        <input checked="" class="sr-only peer" name="gender" type="radio" value="male" checked />
                        <div
                            class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">
                            Male</div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input class="sr-only peer" name="gender" type="radio" value="female" />
                        <div
                            class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">
                            Female</div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input class="sr-only peer" name="gender" type="radio" value="other" />
                        <div
                            class="w-full h-full flex items-center justify-center rounded-lg text-on-surface-variant font-bold text-sm peer-checked:bg-primary-container peer-checked:text-on-primary-container transition-all">
                            Other</div>
                    </label>
                </div>
            </div>

            <!-- Create Account Button -->
            <button
                class="w-full signature-gradient text-on-primary-container font-headline font-extrabold text-sm uppercase tracking-widest py-4 rounded-lg shadow-xl shadow-primary/10 active:scale-[0.98] transition-transform duration-200 mt-6"
                type="submit">
                Create Account
            </button>
        </form>
        <!-- Footer Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-on-surface-variant font-label">
                Already have an account?
                <a class="text-primary font-bold hover:text-primary-fixed-dim transition-colors ml-1 decoration-primary/30 underline-offset-4 underline"
                    href="login.php">Log in</a>
            </p>
        </div>
    </div>
    <!-- Decorative Subtle Background Element -->
    <div class="fixed top-0 right-0 -z-10 opacity-20">
        <div class="w-[800px] h-[800px] rounded-full blur-[150px] bg-primary/10 translate-x-1/2 -translate-y-1/2"></div>
    </div>
    <div class="fixed bottom-0 left-0 -z-10 opacity-10">
        <div class="w-[600px] h-[600px] rounded-full blur-[120px] bg-tertiary/10 -translate-x-1/2 translate-y-1/2">
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>