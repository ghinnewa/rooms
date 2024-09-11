require('./bootstrap');
// resources/js/app.js
import Echo from "laravel-echo";
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

window.Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        // Append the notification message to the notification list
        $('#notification-list').prepend(`
            <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> ${notification.message}
                <span class="float-right text-muted text-sm">${moment(notification.created_at).fromNow()}</span>
            </a>
            <div class="dropdown-divider"></div>
        `);

        // Update the notification count
        let count = parseInt($('#notification-count').text()) + 1;
        $('#notification-count').text(count);
        $('#notification-count-text').text(count);
    });
