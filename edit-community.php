<?php
require_once "config/db.php";
require_once "config/auth.php";
require_once "func/func_user.php";
require_once "class/class.Community.php";
isLoggedIn();

if (!isset($_GET['cid']) || empty($_GET['cid'])) {
    header("Location: communities.php");
    exit();
}

$cid = intval($_GET['cid']);
$uid = $_SESSION['uid'];

$communityObj = new Community($conn, $uid);
$community = $communityObj->getCommunity($cid);

if (!$community) {
    header("Location: communities.php");
    exit();
}

// Check if user is the owner
if ($community['created_by'] != $uid) {
    header("Location: view-community.php?cid=" . $cid);
    exit();
}

$pageTitle = 'Edit Community | ' . htmlspecialchars($community['name']);
include 'includes/header.php';
include 'includes/sidebar.php';

$categories = [
    "technology" => "Technology",
    "arts" => "Arts & Culture",
    "sports" => "Sports & Fitness",
    "gaming" => "Gaming",
    "education" => "Education",
    "health" => "Health & Wellness",
    "business" => "Business & Entrepreneurship",
    "community" => "Community & Social",
    "music" => "Music",
    "photography" => "Photography",
    "travel" => "Travel & Adventure",
    "food" => "Food & Cooking",
    "fashion" => "Fashion",
    "science" => "Science & Research",
    "environment" => "Environment",
    "finance" => "Finance & Investment",
    "spirituality" => "Spirituality & Mindfulness",
    "literature" => "Literature & Books",
    "film" => "Film & Cinema",
    "activism" => "Social Activism",
    "other" => "Other"
];

$districts = ["Achham", "Arghakhanchi", "Baglung", "Baitadi", "Bajhang", "Bajura", "Banke", "Bara", "Bardiya", "Bhaktapur", "Bhojpur", "Chitwan", "Dadeldhura", "Dailekh", "Dang", "Darchula", "Dhading", "Dhankuta", "Dhanusha", "Dolakha", "Dolpa", "Doti", "Eastern Rukum", "Gorkha", "Gulmi", "Humla", "Ilam", "Jajarkot", "Jhapa", "Jumla", "Kailali", "Kalikot", "Kanchanpur", "Kapilvastu", "Kaski", "Kathmandu", "Kavrepalanchok", "Khotang", "Lalitpur", "Lamjung", "Mahottari", "Makwanpur", "Manang", "Morang", "Mugu", "Mustang", "Myagdi", "Nawalparasi (Bardaghat Susta East)", "Nawalparasi (Bardaghat Susta West)", "Nuwakot", "Okhaldhunga", "Palpa", "Panchthar", "Parbat", "Parsa", "Pyuthan", "Ramechhap", "Rasuwa", "Rautahat", "Rolpa", "Rupandehi", "Salyan", "Sankhuwasabha", "Saptari", "Sarlahi", "Sindhuli", "Sindhupalchok", "Siraha", "Solukhumbu", "Sunsari", "Surkhet", "Syangja", "Tanahun", "Taplejung", "Terhathum", "Udayapur", "Western Rukum"];
?>

<!-- Main Content Area -->
<main class="ml-20 lg:ml-64 min-h-screen">
    <div class="max-w-4xl mx-auto py-16 px-12">
        <header class="mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-on-surface mb-2">
                <a href="view-community.php?cid=<?= $cid ?>"
                    class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-color duration-300">
                    arrow_back_ios
                </a>
                Edit Community
            </h1>
            <p class="text-on-surface-variant">Update the details of your community.</p>
        </header>
        <form id="dataForm" name="dataForm" class="space-y-12" enctype="multipart/form-data">
            <input type="hidden" name="cid" value="<?= $cid ?>">
            <!-- Cover Image Section -->
            <section>
                <label class="block text-sm font-semibold uppercase tracking-widest text-on-surface-variant mb-4">Cover
                    Presence</label>
                <div class="relative group">
                    <div class="h-64 w-full rounded-xl bg-surface-container-low overflow-hidden relative cursor-pointer group"
                        onclick="document.getElementById('cover_image').click()">
                        <img id="cover-preview" class="w-full h-full object-cover opacity-60"
                            src="<?= htmlspecialchars($community['cover_image']) ?>" />
                        <div
                            class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span
                                class="bg-primary-container text-on-primary-container px-6 py-3 rounded-lg font-bold flex items-center gap-2 transform scale-95 transition-all">
                                <span class="material-symbols-outlined">edit</span>
                                Change Picture
                            </span>
                        </div>
                    </div>
                    <label
                        class="absolute bottom-4 right-4 bg-surface-container-highest/80 backdrop-blur-md text-on-surface px-4 py-2 rounded-full text-xs font-bold border border-outline-variant/20 cursor-pointer hover:bg-surface-container-high transition-all"
                        for="cover_image">
                        Upload New Cover
                    </label>
                    <input type="file" id="cover_image" name="cover_image" class="hidden" accept="image/*" />
                </div>
            </section>
            <!-- Basic Info Bento Section -->
            <div class="grid grid-cols-1 gap-8">
                <!-- Name Input (Full Width) -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant"
                        for="comm-name">Community Name</label>
                    <input
                        class="w-full bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all"
                        id="comm-name" name="comm-name" value="<?= htmlspecialchars($community['name']) ?>" type="text" />
                </div>
                <!-- Category and Location: 2-Column Stack on Md+ -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Category Select -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant"
                            for="comm-category">Category</label>
                        <select
                            class="w-full bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface focus:ring-2 focus:ring-primary/50 transition-all"
                            id="comm-category" name="comm-category">
                            <option value="">Select a category</option>
                            <?php foreach ($categories as $val => $label): ?>
                                <option value="<?= $val ?>" <?= ($community['category'] == $val) ? 'selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Location Select -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant"
                            for="comm-location">Location</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">location_on</span>
                            <select
                                class="w-full bg-surface-container-low border-none rounded-xl py-4 pl-12 pr-5 text-on-surface focus:ring-2 focus:ring-primary/50 transition-all"
                                id="comm-location" name="comm-location">
                                <option value="">Select a district</option>
                                <?php foreach ($districts as $district): ?>
                                    <option value="<?= $district ?>" <?= ($community['location'] == $district) ? 'selected' : '' ?>><?= $district ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Description Textarea (Full Width) -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant"
                        for="comm-info">Community Info</label>
                    <textarea
                        class="w-full bg-surface-container-low border-none rounded-xl py-4 px-5 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/50 transition-all resize-none"
                        id="comm-info" name="comm-info"
                        placeholder="Describe the mission, values, and energy of your community..." rows="6"><?= htmlspecialchars($community['description']) ?></textarea>
                </div>
            </div>
            <!-- Action Footer -->
            <footer class="pt-12 mt-12 border-t border-outline-variant/10 flex items-center justify-end gap-6">
                <a href="view-community.php?cid=<?= $cid ?>"
                    class="text-on-surface-variant font-semibold hover:text-on-surface transition-colors">
                    Cancel
                </a>
                <button
                    class="px-10 py-4 bg-gradient-to-br from-primary to-primary-dim text-on-primary-container rounded-xl font-extrabold text-lg shadow-xl shadow-primary/10 hover:shadow-primary/20 transform active:scale-95 transition-all"
                    type="submit">
                    Update Community
                </button>
            </footer>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    const myForm = document.getElementById('dataForm');

    myForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const submitBtn = myForm.querySelector("button[type=submit]");
        submitBtn.disabled = true;
        const formData = new FormData(myForm);

        formData.append('action', 'update');
        fetch('php/community_process.php', {
            method: "POST",
            body: formData
        }).then(response => response.json())
            .then(data => {
                showToast(data.message, data.status, data.timmer);
                if (data.status == 1) {
                    setTimeout(() => {
                        window.location.href = 'view-community.php?cid=<?= $cid ?>';
                    }, data.timmer * 200);
                } else {
                    submitBtn.disabled = false;
                }
            }).catch(error => {
                showToast('Something went wrong', 0, 5);
                submitBtn.disabled = false;
            })
    });

    // Cover image preview
    document.getElementById('cover_image').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('cover-preview');
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>