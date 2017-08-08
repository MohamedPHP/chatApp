<template>
    <ul class="messages">
        <!-- Class left and right -->
        <li v-for="msg in messages" class="message {{ msg.user_id == onlineuser.id ? 'left' : 'right' }} appeared">
            <div class="avatar">
                <img style="width: 100%;height: 100%;border-radius: 50%;" :src="msg.user.image" alt="">
            </div>
            <div class="text_wrapper">
                <div class="text">
                    <span><b>{{ msg.user.name }}</b>  : </span>
                    <span>{{ msg.body }}</span>
                    <small><i class="fa fa-clock-o"></i> {{ msg.created_at | moment "from" }}</small>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    props: ['messages', 'onlineuser'],
    data: function () {
        return {

        }
    },
    ready: function () {

        this.pusherFunc(this.messages);

    },
    methods: {
        pusherFunc: function (messages) {
            var pusher = new Pusher('f6561677a56f57cba371', {
                cluster: 'eu',
                encrypted: true
            });
            var channel = pusher.subscribe(this.$route.params.room_id + 'room');
            channel.bind('newMessage', function(data) {
                messages.push(data);
                $('.messages').animate({ scrollTop: $('.messages').prop('scrollHeight') }, 300);
            });
        }
    },
    events: {
        // was for adding the message into the message box but معلش بئا الدونيا غداره هههههههههههههه
        // MessageAdded2: function (val) {
        //     this.messages.push(val);
        //     $('.messages').animate({ scrollTop: $('.messages').prop('scrollHeight') }, 300);
        // }
    }
}
</script>

<style lang="css">
</style>
