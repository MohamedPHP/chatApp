<template>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group" v-if="activity.length > 0">
                <li v-for="ac in activity" track-by="$index" class="list-group-item">{{ ac }}</li>
            </ul>
            <span v-else>Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['activity'],
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
