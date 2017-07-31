<template>
    <div v-if="isLoading">
        <h2 class="text-primary">Add New Room</h2>
        <hr>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="RoomName">Room Name</label>
                <input type="text" class="form-control" v-model="name" id="RoomName">
            </div>
        </div>
        <button @click="AddRoom" :disabled="disabled" type="button" class="btn btn-default">Add Room</button>
    </div>
    <spinner v-ref:spinner size="xl" fixed text="Loading..."></spinner>
</template>

<script>
export default {
    components: {
        spinner: require('vue-strap/dist/vue-strap.min').spinner,
    },
    data: function () {
        return {
            isLoading: false,
            disabled: false,
            name: '',
        }
    },
    ready: function () {
        this.$refs.spinner.show();
        this.isLoading = true;
        this.$refs.spinner.hide();
    },
    methods: {
        AddRoom: function () {
            this.$refs.spinner.show();
            this.disabled = true;
            this.$http.post('/AddRoom', {'name': this.name}).then(function (response) {
                this.name = '';
                this.disabled = false;
                this.$refs.spinner.hide();
                swal("Good job!", "You clicked the button!", "success");
            }, function (response) {
                this.$refs.spinner.hide();
                this.disabled = false;
                if (response.body == 'error') {
                    alertify.error("There Was An Error [ 1000 ]");

                }else {
                    for (var key in response.body) {
                        alertify.error(response.body[key]);
                    }
                }
            });
        }
    }
}
</script>

<style lang="css">

</style>
