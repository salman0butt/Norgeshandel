
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

import Echo from "laravel-echo"
Pusher.logToConsole = true;

window.Pusher = require('pusher-js');
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'f607688e883e2a04ab39',
  cluster: 'eu',
  forceTLS: true
});

var channel = window.Echo.channel('property-for-rent');

channel.listen('.property-for-rent', function(data)
{

    // console.log(data);
    // return false;

    var user_id = data.user_id;
    var url = data.path;
    var notify_user = "";
    $.ajax({
        type: "POST",
        url: url,
        data:  {'ma': data.notification_id_search},
        dataType: "json",
        async:false,
        success: function(data){
            notify_user = data.res;

        }
    });

    if(($("#user_id_notfy").val() != user_id && $("#user_role_admin").val() == 1) || notify_user == true)
    {
        var html = ""
        html += "<input type='hidden' name='notids[]' value='"+data.notification_id+"'>"
        $("#notifications").append(html);
        var notification_count =  $(":input[name='notids[]']").length;
        $("#notification_count_pro").html(notification_count);
    }

});
