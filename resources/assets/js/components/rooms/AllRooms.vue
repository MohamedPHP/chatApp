<template>
    <div v-if="isLoading">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 nicediv">
                <h3 class="text-center text-primary">All Rooms</h3>
                <hr>
                <table class="table table-bordered">
                    <thead style="background-color: #555; color: #fff;">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>User</th>
                            <th>Messages Count</th>
                            <th>Creation Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="room in rooms">
                            <td>{{ room.id }}</td>
                            <td><a v-link="{name: 'Chatbox', params: {room_id: room.id, room_name: room.name}}">{{ room.name }}</a></td>
                            <td>{{ room.user.name }}</td>
                            <td>{{ room.messages_count }}</td>
                            <td><span>{{ room.created_at | moment "calendar" }}</span></td>
                        </tr>
                    </tbody>
                </table>
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
            rooms: [],
            isLoading: false,
        }
    },
    ready: function () {
        this.$refs.spinner.show();
        this.AllRooms();
    },
    methods: {
        AllRooms: function () {
            this.$http.get('/AllRooms').then(function (response) {
                this.rooms = response.body.rooms;
                this.isLoading = true;
                this.$refs.spinner.hide();
            }, function (response) {
                if (response.body == 'You Need To login.') {
                    alert(response.body);
                    window.location = '/login';
                }
                alert('there is error 1001');
                window.location = '/home';
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
    margin-top: 25px;
}
</style>
