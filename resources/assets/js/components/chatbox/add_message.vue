<template>
    <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
            <input class="message_input" v-model="body" @keyup.enter="AddMessage" placeholder="Type your message here...">
        </div>
        <div class="send_message" @click="AddMessage" style="cursor: pointer;">
            <div class="text">
                Send
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['room'],
    data: function () {
        return {
            body: '',
        }
    },
    methods: {
        AddMessage: function () {
            var formdata = new FormData();
            formdata.append('body', this.body);
            formdata.append('room_id', this.room.id);
            this.$http.post('/AddMessage', formdata).then(function (response) {
                this.$dispatch('MessageAdded', response.body.message);
                this.body = '';
            }, function (response) {
                console.log("error");
            });
        }
    }
}
</script>

<style lang="css">
</style>
