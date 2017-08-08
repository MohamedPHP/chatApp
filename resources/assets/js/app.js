var Vue = require('vue');


// for http requests
var VueResource = require('vue-resource');

Vue.use(VueResource);


Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').attr('value');

Vue.use(require('vue-pusher'), {
    api_key: 'f6561677a56f57cba371',
});

var VueRouter = require('vue-router');

Vue.use(VueRouter);

var moment = require('moment');

moment.locale('eg'); // 'en'.

Vue.use(require('vue-moment'), {
    moment
});

var App = Vue.extend({});

var route = new VueRouter();


route.map({
    '/chatbox/:room_id/:room_name': {
        name: 'Chatbox',
        component: require('./components/chatbox/Chatbox.vue'),
    },
    '/AddRooms': {
        component: require('./components/rooms/AddRooms.vue'),
    },
    '/MyRooms': {
        component: require('./components/rooms/MyRooms.vue'),
    },
    '/AllRooms': {
        component: require('./components/rooms/AllRooms.vue'),
    },
    '/Profile': {
        component: require('./components/user/Profile.vue'),
    },
});


route.start(App, '#app-layout');
