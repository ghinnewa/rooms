require('./bootstrap');
console.log('app.js loaded');

// resources/js/app.js
import Echo from "laravel-echo";
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});


// resources/js/app.js
window.Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        console.log('Notification received:', notification); // Check if URL is present

        // Check if the notification is for the super admin | admin about card creation
        if (notification.type === 'App\\Notifications\\CardCreatedNotification') {
            // Ensure the URL is correctly inserted into the <a> tag
            const url = notification.url || '#'; // Use the notification URL or default to '#'
            $('#notification-list').prepend(`
                <a href="${url}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> ${notification.message}
                    <span class="float-right text-muted text-sm">${moment(notification.created_at).fromNow()}</span>
                </a>
                <div class="dropdown-divider"></div>
            `);
        } else if (notification.type === 'App\\Notifications\\CardApprovalNotification' && notification.message.includes('rejected')) {
            // Student Notification: Trigger modal with edit option for rejected cards
            $('#notification-list').prepend(`
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#notificationModal" 
                   data-message="${notification.message}" data-comment="${notification.comment || ''}" data-card-id="${notification.card_id}">
                    <i class="fas fa-envelope mr-2"></i> ${notification.message}
                    <span class="float-right text-muted text-sm">${moment(notification.created_at).fromNow()}</span>
                </a>
                <div class="dropdown-divider"></div>
            `);
        } else {
            // Other student notifications (e.g., approved cards)
            $('#notification-list').prepend(`
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> ${notification.message}
                    ${notification.comment ? `<div class="text-muted text-sm">${notification.comment}</div>` : ''}
                    <span class="float-right text-muted text-sm">${moment(notification.created_at).fromNow()}</span>
                </a>
                <div class="dropdown-divider"></div>
            `);
        }

        // Update the notification count
        let count = parseInt($('#notification-count').text()) + 1;
        $('#notification-count').text(count);
        $('#notification-count-text').text(count);
    });
