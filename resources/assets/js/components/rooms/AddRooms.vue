<template>
    <div v-if="isLoading">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 nicediv">
                <h2 class="text-primary text-center">Add New Room</h2>
                <hr>
                <div class="form-group">
                    <input type="text" class="form-control" v-model="name" id="RoomName" placeholder="Room Name ...">
                </div>
                <button @click="AddRoom" :disabled="disabled" type="button" class="btn btn-default btn-block">Add Room</button>
            </div>
        </div>
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
                if (response.body == 'You Need To login.') {
                    alert(response.body);
                    window.location = '/login';
                }
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
.nicediv {
    box-shadow: 1px 1px 5px #ccc !important;
    padding: 28px 19px !important;
    margin-bottom: 22px !important;
    margin-top: 64px;
}
</style>
