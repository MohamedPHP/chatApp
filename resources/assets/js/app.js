var Vue = require('vue');


// for http requests
var VueResource = require('vue-resource');

Vue.use(VueResource);


Vue.http.headers.common['X-CSRF-TOKEN'] = $('#_token').attr('value');

var VueRouter = require('vue-router');

Vue.use(VueRouter);

var App = Vue.extend({});

var route = new VueRouter({
    hashbang: false,
    //abstract: true,
    history: true,
    mode: 'html5',
    linkActiveClass: 'active',
    transitionOnLoad: true,
    root: '/home'
});


route.map({
    '/chatbox': {
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
});


route.start(App, '#app-layout');
