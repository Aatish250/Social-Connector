<?php
$pageTitle = 'Create Community | Social Connector';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Area -->
<main class="ml-20 lg:ml-64 min-h-screen">
    <div class="max-w-4xl mx-auto py-16 px-12">
        <header class="mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-on-surface mb-2">
                <a href="communities.php" class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-color duration-300">
                    arrow_back_ios
                </a>
                Create Community
            </h1>
            <p class="text-on-surface-variant">Design the heart of your local network and connect like-minded individuals.</p>
        </header>
        <form class="space-y-12">
            <!-- Cover Image Section -->
            <section>
                <label class="block text-sm font-semibold uppercase tracking-widest text-on-surface-variant mb-4">Cover Presence</label>
                <div class="relative group">
                    <div class="h-64 w-full rounded-xl bg-surface-container-low overflow-hidden relative">
                        <img class="w-full h-full object-cover opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAs26UYOI5HSf5Zj8TqwxRkmo6yBNAd1x9WI15_RDuEHuUghWga7eUIvit5ZLJr2MKxxJJbeeVgm-JZP75BbPYCHk2I33kMrjTdBv3ZDiIO8_VszzAINEr9b-qHi8usqMU1Uc1irXX8FzvZ8dLDVIa8HX7mE0pYxLW_WcTuSBO044h4ngse4irRUrUzKeh2vFC-ls7B8td-llTerX7kBuXV65_M8HzOuQ8p5MWFB5A0p5SokCWrDYidkzCpiyOUBHxGiWT0X7sapQ"/>
                        <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="bg-primary-container text-on-primary-container px-6 py-3 rounded-lg font-bold flex items-center gap-2 transform scale-95 active:opacity-80 transition-all" type="button">
                                <span class="material-symbols-outlined">edit</span>
                                Edit Picture
                            </button>
                        </div>
                    </div>
                    <button class="absolute bottom-4 right-4 bg-surface-container-highest/80 backdrop-blur-md text-on-surface px-4 py-2 rounded-full text-xs font-bold border border-outline-variant/20" type="button">
                        Upload Cover Image
                    </button>
                </div>
            </section>
            <!-- Basic Info Bento Section -->
            <div class="grid grid-cols-1 gap-8">
                <!-- Name Input (Full Width) -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="comm-name">Community Name</label>
                    <input class="w-full bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all" id="comm-name" placeholder="e.g. Nocturne Digital Collective" type="text"/>
                </div>
                <!-- Category and Location: 2-Column Stack on Md+ -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Category Select -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="comm-category">Category</label>
                        <select class="w-full bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface focus:ring-2 focus:ring-primary/50 transition-all" id="comm-category">
                            <option value="">Select a category</option>
                            <option value="technology">Technology</option>
                            <option value="arts">Arts</option>
                            <option value="sports">Sports</option>
                            <option value="gaming">Gaming</option>
                            <option value="education">Education</option>
                            <option value="health">Health</option>
                            <option value="business">Business</option>
                            <option value="community">Community</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <!-- Location Select (77 Districts of Nepal) -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="comm-location">Location</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">location_on</span>
                            <select class="w-full bg-surface-container-low border-none rounded-xl py-4 pl-12 pr-5 text-on-surface focus:ring-2 focus:ring-primary/50 transition-all"
                                id="comm-location">
                                <option value="">Select a district</option>
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
                                <option value="Terhathum">Terhathum</option>
                                <option value="Udayapur">Udayapur</option>
                                <option value="Western Rukum">Western Rukum</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Description Textarea (Full Width) -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="comm-info">Community Info</label>
                    <textarea class="w-full bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all resize-none" id="comm-info" placeholder="Describe the mission, values, and energy of your community..." rows="6"></textarea>
                </div>
            </div>
            <!-- Action Footer -->
            <footer class="pt-12 mt-12 border-t border-outline-variant/10 flex items-center justify-end gap-6">
                <a href="profile.php" class="text-on-surface-variant font-semibold hover:text-on-surface transition-colors">
                    Cancel
                </a>
                <button class="px-10 py-4 bg-gradient-to-br from-primary to-primary-dim text-on-primary-container rounded-xl font-extrabold text-lg shadow-xl shadow-primary/10 hover:shadow-primary/20 transform active:scale-95 transition-all" type="submit">
                    Update Community
                </button>
            </footer>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
