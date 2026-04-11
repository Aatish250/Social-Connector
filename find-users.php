<?php
require_once "config/db.php";
require_once "config/auth.php";
isLoggedIn();

$user = getUserDetail($conn, $_SESSION['uid']);
$pageTitle = 'Find Users | Social Connector';
$currentPage = 'find-users';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Canvas -->
<main class="min-h-screen ml-20 lg:ml-64 flex flex-col pt-16 lg:pt-0">
    <!-- Central Content Area -->
    <div class="flex-1 bg-surface-container-low min-h-screen p-6 md:p-12">
        <!-- Search Header Section -->
        <section class="max-w-5xl mx-auto mb-5">
            <h1 class="text-4xl font-headline font-extrabold text-on-surface mb-8 tracking-tight">Find Users</h1>
            <form class="relative group" id="searchForm">
                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                    <span
                        class="material-symbols-outlined text-on-surface-variant group-focus-within:text-primary transition-colors">search</span>
                </div>
                <input
                    class="w-full bg-surface-container-highest border-none rounded-full py-4 pl-14 pr-16 text-on-surface placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-primary/40 transition-all outline-none font-medium"
                    placeholder="Search by name, interests or location..." type="text" name="searchInput" />
                <div class="absolute -right-4 text-gray-500 inset-y-2 flex">
                    <span class="material-symbols-outlined pt-2">
                        group
                    </span>
                    <input type="number" value="4" name="userLimit" id="userFindLimit"
                        class="bg-transparent border-none w-12 p-1" readonly>
                </div>
            </form>

            <!-- Searched Values -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-5 mt-5"
                id="searchedUser">
            </div>
            <div class="flex justify-center flex-col md:flex-row gap-4">
                <button id="showLessUserFindButton"
                    class="flex m-auto md:m-1 items-center gap-2 px-8 py-3 bg-surface-container-high text-on-surface rounded-full font-bold text-sm hover:bg-surface-variant border border-outline-variant/30 transition-all group">
                    <span>Show Less Suggestions</span>
                    <span
                        class="material-symbols-outlined text-lg group-hover:translate-y-0.5 transition-transform">expand_less</span>
                </button>
                <button id="showMoreUserFindButton"
                    class="flex m-auto md:m-1 items-center gap-2 px-8 py-3 bg-surface-container-high text-on-surface rounded-full font-bold text-sm hover:bg-surface-variant border border-outline-variant/30 transition-all group">
                    <span>Show More Suggestions</span>
                    <span
                        class="material-symbols-outlined text-lg group-hover:translate-y-0.5 transition-transform">expand_more</span>
                </button>
            </div>
            <script>
                // Helper function to update buttons visibility depending on search input content
                function updateShowMoreLessButtons() {
                    const input = document.querySelector('#searchForm input[name="searchInput"]');
                    const showMore = document.getElementById('showMoreUserFindButton');
                    const showLess = document.getElementById('showLessUserFindButton');
                    if (!input.value || input.value.trim() === '') {
                        showMore.classList.add('hidden');
                        showLess.classList.add('hidden');
                    } else {
                        showMore.classList.remove('hidden');
                        // ShowLess may be hidden if under 4, so we use toggleShowLess to control that
                        toggleShowLess();
                    }
                }

                // Increment/Decrement logic
                document.getElementById("showLessUserFindButton").addEventListener("click", function () {
                    let userFindLimitEl = document.getElementById("userFindLimit");
                    if (!userFindLimitEl) return;
                    let val = parseInt(userFindLimitEl.value || userFindLimitEl.textContent || 4, 10);
                    val = Math.max(1, val - 4);
                    if (userFindLimitEl.value !== undefined) {
                        userFindLimitEl.value = val;
                    } else {
                        userFindLimitEl.textContent = val;
                    }
                    toggleShowLess();
                });

                document.getElementById("showMoreUserFindButton").addEventListener("click", function () {
                    let userFindLimitEl = document.getElementById("userFindLimit");
                    if (!userFindLimitEl) return;
                    let val = parseInt(userFindLimitEl.value || userFindLimitEl.textContent || 4, 10);
                    val = val + 4;
                    if (userFindLimitEl.value !== undefined) {
                        userFindLimitEl.value = val;
                    } else {
                        userFindLimitEl.textContent = val;
                    }
                    toggleShowLess();
                });

                function toggleShowLess() {
                    const userFindLimitEl = document.getElementById("userFindLimit");
                    const showLessUserFindButton = document.getElementById("showLessUserFindButton");
                    const input = document.querySelector('#searchForm input[name="searchInput"]');
                    if (!userFindLimitEl || !showLessUserFindButton) return;
                    // Only show if input is not empty!
                    if (!input.value || input.value.trim() === '') {
                        showLessUserFindButton.classList.add('hidden');
                        return;
                    }
                    let userFindLimit = parseInt(userFindLimitEl.value || userFindLimitEl.textContent || 4, 10);
                    if (userFindLimit <= 4) {
                        showLessUserFindButton.classList.add('hidden');
                    } else {
                        showLessUserFindButton.classList.remove('hidden');
                    }
                }

                // Set up input event to toggle buttons based on input
                document.querySelector('#searchForm input[name="searchInput"]').addEventListener('input', updateShowMoreLessButtons);

                // Initial run
                updateShowMoreLessButtons();
            </script>
        </section>
        <!-- Results Sections -->
        <div class="max-w-5xl mx-auto space-y-20">
            <!-- Pending Requests -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-on-surface-variant">Pending Requests
                    </h2>
                    <span class="text-xs text-primary font-bold">2 Notifications</span>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Request Card 1 -->
                    <div
                        class="bg-surface-container-high p-6 rounded-xl flex items-center justify-between group hover:bg-surface-variant transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <img alt="Elena Vance"
                                class="w-14 h-14 rounded-lg object-cover grayscale group-hover:grayscale-0 transition-all"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDG8T0LBnQw6VrcTBtPEV3COXLtJ2o4gZXCiIw_kHCNw_TbBJNKd-w9cHq35b51f6TRRcKU3X4nAO5YG5bwwxBJDZAZQVaQkUR6TrB8_VhcZ2gYQGbIliKMaFcRCPD9LqknIkLra047vKwegGirTb7IOtiJdPlfqXETigJqP-1SmWYmJMhI70qSpdqKq5wz8XU7A6l0UdGcTHsQK2im68dORQCqcuaeZ2hrMh-RiPGfKJ6CK106ofJEr9KYBcKcrF6nfxVQvym6IQ" />
                            <div>
                                <h3 class="font-headline font-bold text-on-surface">Elena Vance</h3>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="bg-primary-container text-on-primary-container px-4 py-2 rounded-lg text-xs font-bold hover:scale-[1.02] active:scale-95 transition-all">Accept</button>
                            <button
                                class="bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-xs font-bold border border-outline-variant hover:bg-error-container/20 hover:border-error-dim transition-all">Decline</button>
                        </div>
                    </div>
                    <!-- Request Card 2 -->
                    <div
                        class="bg-surface-container-high p-6 rounded-xl flex items-center justify-between group hover:bg-surface-variant transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <img alt="Marcus Thorne"
                                class="w-14 h-14 rounded-lg object-cover grayscale group-hover:grayscale-0 transition-all"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCyWsxRzH2Dk43cMpLkCzHoaSexfHXc6eHwYKfs78tlh2sjD9m77FnninJWRRfROMX1Iiq6NvcRyjg5YesNN51NAgpsKXMiuiEGh_c2JXPm2sXQFjdZFiyu4-wnBJRKbTz-miimyUQXcwiWW0JOc4ewsHWKuLMgOup9Ko5yzA9fDh_IFiukTPriBe7341UH1BPs4JaIOCejZ6DCo9Y5MXEu6x4K-oGfnos9XHMnSmm2oT7lS6JJ4SyM4Xn4OAb0YE9Mo9SE-DARpg" />
                            <div>
                                <h3 class="font-headline font-bold text-on-surface">Marcus Thorne</h3>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="bg-primary-container text-on-primary-container px-4 py-2 rounded-lg text-xs font-bold hover:scale-[1.02] active:scale-95 transition-all">Accept</button>
                            <button
                                class="bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-xs font-bold border border-outline-variant hover:bg-error-container/20 hover:border-error-dim transition-all">Decline</button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- People You May Know -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-on-surface-variant">People You May Know
                    </h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
                    <!-- Suggestion 1 -->
                    <form data-uid="0"
                        class="userCard flex flex-col items-center text-center p-8 bg-surface-container-high rounded-2xl border border-transparent hover:border-outline-variant/20 transition-all group">
                        <div class="relative mb-4">
                            <img alt="Liam Carter"
                                class="w-24 h-24 rounded-full object-cover p-1 border-2 border-primary/20 group-hover:border-primary transition-all"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGspwDWBdWLVMTYZsa1yji1XGc7DedPj1hv6nXAGnlaCJVn2RT7Kxq0KWtP8I1UB5adTLC_Jh9xPypXiPR7tWLeRMbrag0egrnXgCv1zS3BTD926PYmy4cdVO5YvuzMjLZDdcibMOZ2gJlZ-2bzYDbptGjyGvNXrr73C04fRUM6VgrSv-3OMGGqz7-I9JiJ3XnkG19tPOvP3fFfi6MjBi0I5rT7ch87tKfy5SKS482yHJD1q7zOxEiYouxtm9FuLtLKLqAADWHSA" />
                        </div>
                        <h3 class="font-headline font-bold text-lg text-on-surface mb-6">Liam Carter</h3>
                        <button
                            class="w-full bg-surface-variant text-on-surface py-3 rounded-lg text-xs font-bold hover:bg-primary hover:text-on-primary-container transition-all">Connect</button>
                    </form>
                </div>
                <div class="flex justify-center">
                    <button
                        class="flex items-center gap-2 px-8 py-3 bg-surface-container-high text-on-surface rounded-full font-bold text-sm hover:bg-surface-variant border border-outline-variant/30 transition-all group">
                        <span>Show More Suggestions</span>
                        <span
                            class="material-symbols-outlined text-lg group-hover:translate-y-0.5 transition-transform">expand_more</span>
                    </button>
                </div>
            </section>
            <!-- Search Empty State Style -->
            <section
                class="grid grid-cols-1 md:grid-col-2 lg:grid-cols-3 gap-8 items-center bg-surface-container-highest/30 p-8 rounded-3xl">
                <div class="md:col-span-3 space-y-4">
                    <h2 class="text-3xl font-headline font-bold text-on-surface">Can't find who you're looking for?</h2>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Expand your network by importing contacts
                        or inviting your colleagues to join the premium social ecosystem.</p>
                    <div class="pt-4 flex flex-wrap gap-4">
                        <button
                            class="px-6 py-3 bg-primary text-on-primary-container rounded-full font-bold text-xs hover:shadow-[0_0_20px_rgba(172,138,255,0.4)] transition-all">Invite
                            via Email</button>
                        <button
                            class="px-6 py-3 border border-outline-variant text-on-surface rounded-full font-bold text-xs hover:bg-surface-variant transition-all">Sync
                            Contacts</button>
                    </div>
                </div>
                <div class="md:col-span-2 relative h-48 w-full overflow-hidden rounded-2xl">
                    <img alt="People connecting" class="absolute inset-0 w-full h-full object-cover opacity-60"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYLCvrnN32DcTBx6peOV00VejhwbO782cr20E2vE2VWU1JT6_LFhezwrSR8fCVfzcfDNPkzlDzHO0RcqWdYXWHRAypsVfrv1o4LiflWU7Yh5PvUGJR0Bf0VkWL_73zboF75xnLoy0dbifwiupWLdxiHs51A0Y0M_8htHzX6I6eE4NoBkvIitMVOnzE8Caq5yiZ_dVdAJ3AMPN7OM6o0XX5P7Qg9RmOc-ZvFXh1enF0W_MzOLheSFMwk2Z4u3-SZeJUTTtxIQhfOA" />
                    <div class="absolute inset-0 bg-gradient-to-t from-surface to-transparent"></div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script> // Search user functions
    // on sharch input execute query to find user
    let searchForm = document.getElementById("searchForm");
    searchForm.addEventListener("input", () => { fetchUser(); });
    // on show more / less execute query to find user
    document.getElementById("showLessUserFindButton").addEventListener("click", () => { fetchUser(); });
    document.getElementById("showMoreUserFindButton").addEventListener("click", () => { fetchUser(); });

    // execute query function
    function fetchUser() {
        let searchForm = document.getElementById("searchForm");
        input = searchForm.querySelector('input[type=text]').value;
        // console.log(input);
        if (!input || input == "") {
            document.getElementById("searchedUser").innerHTML = "";
            document.getElementById("showLessUserFindButton").classList.add("hidden");
            document.getElementById("showMoreUserFindButton").classList.add("hidden");
            return false;
        } else {
            document.getElementById("showLessUserFindButton").classList.add("display-block");
            document.getElementById("showMoreUserFindButton").classList.add("display-block");
        }
        formData = new FormData(searchForm);
        fetch("php/search_user_process.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById("searchedUser").innerHTML = data;
                userConnectButton(document.querySelectorAll('.searchUserCard'));
            })
    }
</script>


<script>//on connect button click

    userConnectButton(document.querySelectorAll(".userCard"));

    function userConnectButton(userCards) {
        userCards.forEach(card => {
            card.querySelector("button").addEventListener("click", (e) => {
                e.preventDefault();
                const uid = card.dataset.uid;
                console.log("Clicked " + uid);

                formData = new FormData();
                formData.append('reciver_uid', uid);
                fetch("php/send_user_connection.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status);
                        fetchUser();
                    });
            })
        });
    }

    function send_user_connection() {

    }


</script>