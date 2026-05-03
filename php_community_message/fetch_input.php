<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/config/auth.php";

$cid = isset($_GET['target']) ? (int) $_GET['target'] : 0;

if ($cid > 0): ?>
    <div class="p-6 bg-surface-variant">
        <form id="community-chat-form" class="max-w-4xl mx-auto relative flex items-center gap-3">
            <div
                class="flex-1 bg-surface-container-highest rounded-2xl flex items-center px-4 py-2 ring-1 ring-primary/30 shadow-[0_0_15px_rgba(172,138,255,0.2)] focus-within:ring-primary/60 transition-all">
                <input id="message-input" autocomplete="off"
                    class="flex-1 bg-transparent border-none focus:ring-0 text-on-surface placeholder:text-on-surface-variant py-3"
                    placeholder="Type your message..." type="text" />
            </div>
            <button type="submit"
                class="bg-primary text-on-primary-container w-12 h-12 flex items-center justify-center rounded-xl shadow-lg shadow-primary/10 active:scale-90 transition-transform">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">send</span>
            </button>
        </form>
    </div>
<?php endif; ?>