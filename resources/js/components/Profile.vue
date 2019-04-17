<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Profile
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <p>Tên người dùng: {{ user.name }}</p>
                    <p>Địa chỉ: {{ user.address }}</p>
                    <p>Số điện thoại: {{ user.phone }}</p>
                    <p>Email: {{ user.email }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            user: {}
        }
    },
    created() {
        this.user = infoUser
    }
}
</script>
