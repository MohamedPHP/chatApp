<template>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-success text-center">Online Users In This Room</h4>
            <ul v-if="whoisonline.length > 0" class="list-group">
                <li class="list-group-item" track-by="$index" v-for="user in whoisonline"><img style="width: 32px;height: 32px;border-radius: 50%;margin-right: 10px;" :src="user.users.image" alt="{{ user.users.name }}"> {{user.users.name}} <span style="color: rgb(66, 183, 42); float:right"><i class="fa fa-circle"></i></span></li>
            </ul>
            <span v-else>Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['whoisonline'],
    components: {

    },
    data: function () {
        return {

        }
    },
    ready: function () {

    }
}
</script>

<style lang="css">

</style>
