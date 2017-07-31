<template lang="html">
    <div v-if="isLoading">
        <h4>Room name is {{ room_name }}</h4>
        <br>
        <div class="chat_window">
            <div class="top_menu">
                <div class="title">
                    Chat of room {{ room_name }}
                </div>
            </div>
            <all_messages :messages="room.messages" :onlineuser="onlineUser"></all_messages>
            <add_message :room="room"></add_message>
        </div>
        <br />
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
        }
    },
    components: {
        all_messages: require('./all_messages.vue'),
        add_message: require('./add_message.vue'),
        spinner: require('vue-strap/dist/vue-strap.min').spinner,
    },
    ready: function () {
        this.$refs.spinner.show();
        this.getAlMessages();
    },
    methods: {
        getAlMessages: function () {
            this.room_name = this.$route.params.room_name;
            this.$http.get('/getRoomMessages/'+this.$route.params.room_id).then(function (response) {
                this.room = response.body.room;
                this.onlineUser = response.body.onlineUser;
                this.isLoading = true;
                this.$refs.spinner.hide();
            }, function (response) {
                alert('error 1002 messages');
                // window.location = '/home';
            });
        }
    },
    events: {
        MessageAdded: function (val) {
            this.$broadcast('MessageAdded2', val);
        }
    }
}
</script>
