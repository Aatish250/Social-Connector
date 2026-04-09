<!-- Toast Notification (hidden by default) -->
<div id="toast"
    class="fixed top-5 right-1 transform z-50 min-w-[200px] max-w-xs bg-surface-container-high border border-outline rounded-lg px-4 py-3 shadow-lg flex items-center gap-2 pointer-events-none opacity-0 transition-opacity duration-200 text-sm font-medium"
    role="alert" aria-live="polite" style="display: none">
    <span id="toastIcon" class="material-symbols-outlined text-xl"></span>
    <span id="toastMsg"></span>
</div>
<script>
    // Show toast. status: true/false | 1/0
    function showToast(message, status = 1, timer = 3.5) {
        timer *= 1000;
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toastMsg');
        const toastIcon = document.getElementById('toastIcon');
        toastMsg.textContent = message || '';
        if (status) {
            toast.classList.remove('text-error', 'bg-error-container');
            toast.classList.add('text-[#ceefce]', 'bg-[#376e37]');
            toastIcon.textContent = "check_circle";
        } else {
            toast.classList.remove('text-[#ceefce]', 'bg-[#376e37]');
            toast.classList.add('text-error', 'bg-error-container');
            toastIcon.textContent = "error";
        }
        toast.style.display = '';
        setTimeout(() => {
            toast.classList.add('opacity-100');
            toast.classList.remove('opacity-0');
        }, 30);

        // Hide after timer (ms)
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
            setTimeout(() => { toast.style.display = 'none'; }, 250);
        }, typeof timer === 'number' && timer > 0 ? timer : 3500);
    }
</script>

<?php
// PHP function to emit toast display JS code
// If status is 'error', allow only 'success' as accepted input (ignore or fallback error status)
// Otherwise, allow any status as input
function showToast($message, $status = 'success', $timer = 3.5) {
    $safeMessage = htmlspecialchars($message, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    // If user requests 'error', force status to 'success'
    if ($status != 'success') {
        $status = 'error';
    }
    echo "<script>showToast('{$safeMessage}', '{$status}');</script>";
}
?>