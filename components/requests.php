<!-- Pending Requests -->
<section id="requestSection">
    <!-- contents to be fetch from show_request.php -->
</section>

<script>
    const currentPath = window.location.pathname;
    const isProfilePage = currentPath.includes("/profile");

    const requestSection = document.getElementById("requestSection");
    function loadRequests() {
        // const dataForm = new FormData();
        fetch("php/show_request.php").then(responce => responce.text())
            .then(data => {
                requestSection.innerHTML = data;
                requestActionButton();
            });
    }
    loadRequests();

    function requestActionButton() {
        userRequestCards = document.querySelectorAll(".userRequestCard");
        userRequestCards.forEach(card => {
            const cardUid = card.dataset.cardUid;

            const acceptBtn = card.querySelector(".acceptBtn");
            if (acceptBtn) {
                const newAcceptBtn = acceptBtn.cloneNode(true);
                acceptBtn.parentNode.replaceChild(newAcceptBtn, acceptBtn);
                newAcceptBtn.addEventListener("click", e => {
                    e.preventDefault();
                    console.log("accept uid:" + cardUid);

                    fetch(`php/show_request.php?action=accept&card_uid=${cardUid}`)
                        .then(response => response.json())
                        .then(data => {
                            showToast(data.message, data.status, data.timmer);
                            loadRequests();
                            if (!isProfilePage) loadSuggestion(suggestionLimit = 4);
                        })
                        .catch(error => showToast(error, 0));
                    // loadRequests();
                })
            }

            const declineBtn = card.querySelector(".declineBtn");
            if (declineBtn) {
                const newDeclineBtn = declineBtn.cloneNode(true);
                declineBtn.parentNode.replaceChild(newDeclineBtn, declineBtn);
                newDeclineBtn.addEventListener("click", e => {
                    e.preventDefault();
                    console.log("accept uid:" + cardUid);

                    fetch(`php/show_request.php?action=decline&card_uid=${cardUid}`)
                        .then(response => response.json())
                        .then(data => {
                            showToast(data.message, data.status, data.timmer);
                            loadRequests();
                            if (!isProfilePage) loadSuggestion(suggestionLimit = 4);
                        })
                        .catch(error => showToast(error, 0));
                    // loadRequests();
                })
            }

            const cancelBtn = card.querySelector(".cancelBtn");
            if (cancelBtn) {
                const newCancelBrn = cancelBtn.cloneNode(true);
                cancelBtn.parentNode.replaceChild(newCancelBrn, cancelBtn);
                newCancelBrn.addEventListener("click", e => {
                    e.preventDefault();
                    console.log("cancel uid:" + cardUid);

                    fetch(`php/show_request.php?action=cancel&card_uid=${cardUid}`)
                        .then(response => response.json())
                        .then(data => {
                            showToast(data.message, data.status, data.timmer);
                            loadRequests();
                            if (!isProfilePage) loadSuggestion(suggestionLimit = 4);
                        })
                        .catch(error => showToast(error, 0));
                    // loadRequests();
                })
            }
        });
    }
</script>