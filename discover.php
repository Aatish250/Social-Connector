<?php
require_once "config/db.php";
require_once "config/auth.php";
require_once "func/func_user.php";
isLoggedIn();

$uid = $_SESSION['uid'];

$pageTitle = 'Discover | Social Connector';
$currentPage = 'discover';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Canvas -->
<main class="ml-20 lg:ml-64 min-h-screen pt-16 lg:pt-0">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <!-- Header & Search Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div>
                <h1 class="text-5xl lg:text-6xl font-headline font-black tracking-tight text-on-surface mb-2">Discover
                </h1>
                <p class="text-on-surface-variant max-w-md text-lg leading-relaxed">Connect with minds that challenge
                    the status quo and push visual boundaries.</p>
            </div>
            <!-- Search Communityes...pending to make -->
            <!-- <div class="relative w-full md:w-96 group">
                <span
                    class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input
                    class="w-full bg-surface-container-highest border-none rounded-full py-4 pl-14 pr-6 focus:ring-1 focus:ring-primary text-on-surface placeholder:text-outline transition-all duration-300"
                    placeholder="Search Community..." type="text" />
            </div> -->
        </div>

        <!-- Recomendation section -->
        <div class="flex items-center my-3">
            <hr class="flex-grow border-t border-outline-variant/20">
            <span class="mx-3 text-xs text-on-surface-variant font-medium uppercase tracking-widest">
                Recomended
            </span>
            </span>
            <hr class="flex-grow border-t border-outline-variant/20">
        </div>

        <section>
            <!-- Bento Community Grid -->
            <div id="community-grid"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 transition-opacity duration-300 mb-10">
                <?php
                define('INCLUDED', true);
                include "php/suggest_community.php";
                ?>
            </div>
        </section>

        <!-- Random Community -->
        <div class="flex items-center my-3">
            <hr class="flex-grow border-t border-outline-variant/20">
            <span class="mx-3 text-xs text-on-surface-variant font-medium uppercase tracking-widest">
                Other community
            </span>
            </span>
            <hr class="flex-grow border-t border-outline-variant/20">
        </div>
        <section>
            <div id="other-community-grid"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 transition-opacity duration-300">
                <?php
                // define('INCLUDED_OTHER_COMMUNITY', true);
                include("php/show_other_communities.php");
                ?>
            </div>
            <div class="flex items-center justify-center gap-4 mt-6">
                <button onclick="setOtherCommLimit(-4)" id="otherCommBtnLess"
                    class="px-6 py-3 rounded-full bg-surface-container-highest text-on-surface font-semibold shadow hover:bg-surface-container-high focus:outline-none focus:ring-2 focus:ring-primary/30 border border-outline/10 transition duration-200 flex items-center">
                    <span class="material-symbols-outlined align-middle mr-2"
                        style="vertical-align:middle;">expand_less</span>
                    Show Less
                </button>
                <button onclick="setOtherCommLimit(4)" id="otherCommBtnMore"
                    class="px-6 py-3 rounded-full bg-surface-container-highest text-on-surface font-semibold shadow hover:bg-surface-container-high focus:outline-none focus:ring-2 focus:ring-primary/30 border border-outline/10 transition duration-200 flex items-center">
                    <span class="material-symbols-outlined align-middle mr-2"
                        style="vertical-align:middle;">expand_more</span>
                    Show More
                </button>
            </div>
       
        </section>

    </div>
</main>

<script>
    let other_comm_limit = 4;
    const otherCommBtnMore = document.querySelector("#otherCommBtnMore");
    const otherCommBtnLess = document.querySelector("#otherCommBtnLess");

    function updateOtherCommBtns() {
        // Hide Less button if limit is <= 4, else show
        if (other_comm_limit <= 4) {
            otherCommBtnLess.classList.add("hidden");
        } else {
            otherCommBtnLess.classList.remove("hidden");
        }
        // Hide More button if limit is >= 16, else show
        if (other_comm_limit >= 16) {
            otherCommBtnMore.classList.add("hidden");
        } else {
            otherCommBtnMore.classList.remove("hidden");
        }
    }

    updateOtherCommBtns();

    function setOtherCommLimit(n) {
        other_comm_limit += n;
        if (other_comm_limit < 4) {
            other_comm_limit = 4;
        }
        if (other_comm_limit > 16) {
            other_comm_limit = 16;
        }
        updateOtherCommBtns();
        loadOtherCommunities(other_comm_limit);
    }
    
    function loadRecommendedCommunities() {
        const grid = document.getElementById('community-grid');
        grid.style.opacity = '0.5';

        fetch('php/suggest_community.php')
            .then(response => response.text())
            .then(html => {
                grid.innerHTML = html;
                grid.style.opacity = '1';
            })
            .catch(error => {
                console.error('Error loading communities:', error);
                grid.style.opacity = '1';
            });
    }

    function joinCommunity(cid) {
        fetch(`php/community_process.php?action=join&cid=${cid}`)
            .then(response => response.json())
            .then(data => {
                showToast(data.message, data.status, data.timmer);
                if (data.status === 1) {
                    // Refresh the grid instead of the whole page
                    loadRecommendedCommunities();
                    loadOtherCommunities(other_comm_limit);
                }
            })
            .catch(error => {
                showToast("Something went wrong", 0);
            });
    }

    function loadOtherCommunities(other_comm_limit = 4) {
        const grid = document.getElementById('other-community-grid');

        fetch(`php/show_other_communities.php?limit=${other_comm_limit}`)
            .then(response => response.text())
            .then(html => {
                grid.innerHTML = html;
            })
    }

</script>

<?php include 'includes/footer.php'; ?>