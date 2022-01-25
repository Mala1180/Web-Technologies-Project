$(document).ready(function () {
    getNotifications();

    // setup confirm modal
    $(".confirm-modal h2").text("Vuoi eliminare questa notifica?");
    $(".confirm-modal #yes").click(function () {
        deleteNotification($(this).val());
    });
    $(".confirm-modal #no").click(function () {
        $(".confirm-modal").addClass("hidden");
    });
});


/**
 * Executes a GET request to server for get user notifications. Then calls displayNotifications.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 */
 function getNotifications() {
    reqHelper.get("notification", "getnotifications", {}, function (res) {
        if (res.success) {
            notifications = res.data;
            displayNotifications(notifications);
        } else {
            console.error("An error occurred while getting notifications.");
        }
    });
}


/**
 * Appends notifications in the list.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Array} notifications array of notifications to be displayed
 */
 function displayNotifications(notifications) {
    if (notifications) {
        $("main > .notifications-list").empty();
        for (let i = 0; i < notifications.length; i++) {
            const notification = notifications[i];
            const $notification = $(`
            <li id="${notification.id}">
                <div>
                    <div>
                        <div>
                            <span class="dot"></span>
                            <h2 class="subject">${notification.subject}</h2>
                        </div>
                        <span class="date">${notification.date}</span>
                    </div>
                    <div>
                        <button class="read-button">Leggi</button>
                        <button class="trash-button">
                            <img src="./public/img/icons/bin.png" alt="cestino elimina notifica">
                        </button>
                    </div>
                </div>
                <p class="message">${notification.message}</p>
            </li>`);
            
            $("main > .notifications-list").append($notification);

            // hide the dot if notification is read
            $notification.find(".dot").css("visibility", notification.isRead === 1 ? "hidden" : "");

            // add listener to the button to open the notification
            $notification.find(".read-button").click(function () {
                $notification.find(".message").slideToggle("fast");
                $(this).text($(this).text() === "Leggi" ? "Chiudi" : "Leggi");
                // notification is not read, update it on db
                if (notification.isRead === 0) {
                    $notification.find(".dot").css("visibility", "hidden");
                    reqHelper.post("notification", "readnotification", {
                        notificationId: notification.id
                    }, function (res) {
                        if (res.success) {
                            getUnreadNotificationsNumber();
                        } else {
                            console.error("An error occurred while marking notification as read.");
                        }
                    });
                }
            });

            // add listener to the icon to delete the notification
            $notification.find(".trash-button").click(function (event) {
                if (!$(".confirm-modal").hasClass("hidden")) {
                    $(".confirm-modal").addClass("hidden");
                    return;
                }
                event.stopPropagation();
                $(".confirm-modal").removeClass("hidden");
                $(".confirm-modal #yes").val(notification.id);
            });
        }
    }
}

/**
 * Executes a POST request to server for delete a notification and remove the item from list.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Number} notificationId id of the notification to be deleted
 */
function deleteNotification(notificationId) {
    reqHelper.post("notification", "deletenotification", {
        notificationId: notificationId
    }, function (res) {
        if (res.success) {
            $("#" + notificationId).remove();
        } else {
            console.error("An error occurred while deleting notification.");
        }
    });
    $(".confirm-modal").addClass("hidden");
}