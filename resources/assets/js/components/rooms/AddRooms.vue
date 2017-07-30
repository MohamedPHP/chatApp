<template>
    <div v-if="isLoading">
        <h2 class="text-primary">Add New Room</h2>
        <hr>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="RoomName">Room Name</label>
                <input type="text" class="form-control" id="RoomName">
            </div>
        </div>
        <button type="button" class="btn btn-default">Add Room</button>
    </div>
    <spinner v-ref:spinner size="xl" fixed text="Loading..."></spinner>
</template>

<script>
export default {
    data: function () {
        return {
            isLoading: false,
        }
    },
    components: {
        spinner: require('vue-strap/dist/vue-strap.min').spinner,
    },
    ready: function () {
        this.$refs.spinner.show();
        this.isLoading = true;
        this.$refs.spinner.hide();
    }
}
</script>

<style lang="css">

</style>
