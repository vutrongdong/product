<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Quản lí người dùng
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Quản lí người dùng</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hình ảnh</th>
                                        <th>Họ tên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, idx) in allUsers" :key="'user'+user.id">
                                        <td>{{ ++idx }}</td>
                                        <td><img width="50px" src="/assets/images/user.jpeg" alt="user"></td>
                                        <td>{{ user.name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {getUsers} from  '../../api/user'
export default {
    data() {
        return {
            allUsers:[]
        }
    },
    methods: {
        fetchUsers() {
            getUsers()
            .then(response => {
                this.allUsers = response;
            }).catch( err => {
                console.log(err);
            })      
        }
    },
    created() {
        this.fetchUsers();
    }
}
</script>
