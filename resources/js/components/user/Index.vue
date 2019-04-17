<template>
    <div class="row">
        <div class="col-12">
            <div class="btn-group pull-right m-t-15">
                <router-link :to="{ name: 'user.create'}" class="btn btn-default waves-effect waves-light">Tạo người dùng mới</router-link>
            </div>
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
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Vai trò</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, idx) in allUsers" :key="user.id">
                                        <td>{{ ++idx }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.phone }}</td>
                                        <!-- <td>{{ roleList(user.roles) }}</td> -->
                                        <td>
                                            <router-link class="btn btn-link btn-action text-muted" :to="{name: 'user.edit', params: {id: user.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                                            <a class="btn btn-link btn-action text-danger" @click="delUser(user.id)"><i class="fas fa-trash-alt"></i></a>
                                        </td>
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
import { map } from 'lodash'

export default {
    data() {
        return {
            allUsers:[]
        }
    },
    methods: {
        roleList(roles) {
            let _roleList = map(roles, r => r.name)
            return _roleList.join(", ")
        },

        delUser(uID) {

        }
    },
    computed: {
    },
    mounted() {
    }
}
</script>
