<template>
    <div v-if="isLoading">
        <h3 class="text-center text-primary">My Rooms <small>{{ rooms[0].user.name }} rooms</small></h3>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>User</th>
                    <th>Messages Count</th>
                    <th>Creation Time</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="room in rooms" track-by="$index">
                    <td>{{ room.id }}</td>
                    <td>{{ room.name }}</td>
                    <td>{{ room.user.name }}</td>
                    <td>{{ room.messages_count }}</td>
                    <td><span>{{ room.created_at | moment "calendar" }}</span></td>
                    <td>
                        <button type="button" @click="DeleteRoom($index, room.id)" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
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
            rooms: [],
            isLoading: false,
        }
    },
    ready: function () {
        this.$refs.spinner.show();
        this.MyRooms();
    },
    methods: {
        MyRooms: function () {
            this.$http.get('/MyRooms').then(function (response) {
                this.rooms = response.body.rooms;
                this.isLoading = true;
                this.$refs.spinner.hide();
            }, function (response) {
                alert('there is error 1001');
                window.location = '/home';
            });
        },
        DeleteRoom: function (index, id) {
            this.$http.get('/DeleteRoom/' + id).then(function (response) {
                if (response.body == 'room deleted') {
                    swal("Good job!", "Room Deleted!", "success");
                    this.rooms.splice(index, 1);
                }
            }, function (response) {
                alert('There Is An Error 1001 delete');
                this.$router.go({
                    path: '/AddRooms',
                });
            });
        }
    }
}
</script>

<style lang="css">
</style>
