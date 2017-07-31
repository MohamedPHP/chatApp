<template>
    <ul class="messages">
        <!-- Class left and right -->
        <li v-for="msg in messages" class="message {{ msg.user_id == onlineuser.id ? 'left' : 'right' }} appeared">
            <div class="avatar"></div>
            <div class="text_wrapper">
                <div class="text">{{ msg.body }}</div>
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
        console.log(this.messages);
    },
    events: {
        MessageAdded2: function (val) {
            this.messages.push(val)
            $('.messages').animate({ scrollTop: $('.messages').prop('scrollHeight') }, 300);
        }
    }
}
</script>

<style lang="css">
</style>
