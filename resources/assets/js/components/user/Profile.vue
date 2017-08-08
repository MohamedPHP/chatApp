<template>
    <div v-if="isLoading">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 nicediv">
                <h2 class="text-primary text-center">Add Avatar Image</h2>
                <hr>
                <form>
                    <div class="form-group">
                        <input v-el:image type="file" name="image" class="form-control" id="AvatarImage">
                    </div>
                    <button @click="AddAvatar" :disabled="disabled" type="submit" class="btn btn-default btn-block">Add Avatar Image</button>
                </form>
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
            disabled: false,
            isLoading: false,
        }
    },
    ready: function () {
        this.$refs.spinner.show();
        this.isLoading = true;
        this.$refs.spinner.hide();
    },
    methods: {
        AddAvatar: function (e) {
            e.preventDefault();
            var formdata = new FormData();
            formdata.append('image', this.$els.image.files[0]);
            this.$http.post('/AddAvatar', formdata).then(function (response) {
                swal("Good job!", "Avatar added!", "success");
                $('input[name=image]').val(null);
            }, function (response) {
                if (response.body == 'You Need To login.') {
                    alert(response.body);
                    window.location = '/login';
                }
                for (var key in response.body.image) {
                    alertify.error(response.body.image[key]);
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
