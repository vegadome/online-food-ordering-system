const hostURLStatus = "https://localhost/messy-code/";
function checkForStatusUpdates() {
    fetch(hostURLStatus + "admin/backend/watch-status-change.php")
        .then((response) => response.json())
        .then((current_state) => {
            setTimeout(() => {
                fetch(hostURLStatus + "admin/backend/watch-status-change.php")
                    .then((response) => response.json())
                    .then((new_state) => {
                        isChanged = false
                        new_state.forEach((item, i) => {
                            if (new_state[i].status && current_state[i].status) {
                                if (
                                    new_state[i].status !== current_state[i].status
                                ) {
                                    isChanged = true

                                    let status = new_state[i].status;
                                    let message = "";
                                    let title = "";
                                    let foodName = new_state[i].food_name;
                                    if (status === "accepted") {
                                        title = "Order Accepted";
                                        message = `Order of ${foodName} is accepted by kitchen!`;
                                    } else if (status === "prepared") {
                                        title = "Order Prepared";
                                        message = `Order of ${foodName} is prepared by kitchen!`;
                                    } else if (status === "rejected") {
                                        let reason = new_state[i].reason;
                                        title = "Order Rejected";
                                        message = `Order of ${foodName} is rejected by kitchen!\nReason: ${reason}`;
                                    }

                                    playSound();

                                    const alertDialog =
                                        document.createElement("div");
                                    alertDialog.classList.add("alert-dialog");
                                    alertDialog.innerHTML = `
                                                        <div class="alert-dialog__content border-curve-md p-20 shadow w-fit">
                                                            <h3 class="alert-dialog__title">${title} !</h3>
                                                            <p class="alert-dialog__text mt-20">${message}</p>
                                                            <div class="alert-dialog__actions mt-20 flex items-center">
                                                            <button class="button border-curve-md w-full alert-dialog__action" onclick="hideAlert()">OK</button>
                                                            ${status ===
                                            "rejected"
                                            ? `
                                        <button class="button border-curve-md w-full alert-dialog__action" onclick="redirect()">View</button>`
                                            : ""
                                        } 
                                                            </div>
                                                        </div>
                                                        `;
                                    document.body.appendChild(alertDialog);
                                }
                            }

                        });
                        if (!isChanged) {
                            checkForStatusUpdates();
                        }
                    })
                    .catch((error) => console.error(error));
            }, 5000);

        })
        .catch((error) => console.error(error));
}
checkForStatusUpdates();

function redirect() {
    window.open(hostURLStatus + 'admin/reject-report.php', '_blank')
    const alertDialog = document.querySelector(".alert-dialog");
    alertDialog.remove();
}

function playSound() {
    const audio = new Audio(hostURLStatus + "audio/dog_bark.mp3");
    audio.addEventListener("canplaythrough", () => {
        audio.play();
    });
}

function hideAlert() {
    if (window.location.href.includes('order-details.php')) {
        window.location.reload();
    }
    const alertDialog = document.querySelector(".alert-dialog");
    alertDialog.remove();
}

function sendNotification() {
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    } else {
        Notification.requestPermission().then((permission) => {
            if (permission === "granted") {
                const notification = new Notification("New Order", {
                    body: "You have a new order!",
                    icon: hostURLStatus + "images/logo.png",
                });
                notification.onclick = (event) => {
                    event.preventDefault();
                    window.open(hostURLStatus + "admin/order-details.php", "_blank");
                };
            }
        });
    }
}
