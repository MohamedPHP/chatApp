<template lang="html">
    <div v-if="isLoading">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="chat_window">
                    <div class="top_menu">
                        <div class="title">
                            Chat of room {{ room_name }} <small>Users ({{ OnlineUserCount == '' ? '...' : OnlineUserCount }})</small>
                        </div>
                    </div>
                    <all_messages :messages="room.messages" :onlineuser="onlineUser"></all_messages>
                    <add_message :room="room"></add_message>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <a v-link="{path: '/AllRooms'}" class="btn btn-primary">All Rooms</a>
                    </div>
                    <div class="col-md-6">
                        <a v-link="{path: '/MyRooms'}" class="btn btn-danger pull-right">My Rooms</a>
                    </div>
                </div>
                <hr>
                <activity :activity="activity"></activity>
                <who_is_online :whoisonline="who_is_online"></who_is_online>
            </div>
        </div>
    </div>
    <spinner v-ref:spinner size="xl" fixed text="Loading..."></spinner>
</template>

<script>
export default {
    data: function () {
        return {
            room_name: '',
            room: {},
            isLoading: false,
            onlineUser: {},
            OnlineUserCount: null,
            activity: [],
            who_is_online: [],
        }
    },
    components: {
        all_messages: require('./all_messages.vue'),
        add_message: require('./add_message.vue'),
        activity: require('./Activity.vue'),
        who_is_online: require('./WhoIsOnline.vue'),
        spinner: require('vue-strap/dist/vue-strap.min').spinner,
    },
    ready: function () {
        this.$refs.spinner.show();
        this.getAlMessages();
        this.getOnlineUsers();
        this.PusherUsers();
        window.onbeforeunload = this.leaving;
    },
    methods: {
        leaving: function () {
            this.$http.get('/RemoveLeavingUser/'+this.$route.params.room_id);
        },
        getAlMessages: function () {
            this.room_name = this.$route.params.room_name;
            this.$http.get('/getRoomMessages/'+this.$route.params.room_id).then(function (response) {
                this.room = response.body.room;
                this.onlineUser = response.body.onlineUser;
                this.isLoading = true;
                this.$refs.spinner.hide();
            }, function (response) {
                if (response.body == 'You Need To login.') {
                    alert(response.body);
                    window.location = '/login';
                }
                alert('error 1002 messages');
                // window.location = '/home';
            });
        },
        getOnlineUsers: function () {
            this.$http.get('/getOnlineUsers/'+this.$route.params.room_id).then(function (response) {
                this.OnlineUserCount = response.body.roomOnlineCount;
                this.who_is_online = response.body.who_is_online;
                this.activity.push(response.body.ac);
            }, function (response) {
                alert('error 1003 online users');
                // window.location = '/home';
            });
        },
        PusherUsers: function () {
            var self = this;
            var pusher = new Pusher('f6561677a56f57cba371', { // app key id
                cluster: 'eu',
                encrypted: true
            });
            pusher.subscribe(this.$route.params.room_id + 'onlineuser').bind('onlineUsers', function(data) {
                self.OnlineUserCount = data.roomOnlineCount;
                self.who_is_online = data.who_is_online;
                self.activity.push(data.ac);
            });
            pusher.subscribe(this.$route.params.room_id + 'leaveuser').bind('leaveUsers', function(data) {
                self.OnlineUserCount = data.roomOnlineCount;
                self.who_is_online = data.who_is_online;
                self.activity.push(data.ac);
            });
        },
    },
    events: {
        // was for adding the message into the message box but معلش بئا الدونيا غداره هههههههههههههه
        // MessageAdded: function (val) {
        //     this.$broadcast('MessageAdded2', val);
        // }
    }
}
</script>
