<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Tạo mới bài viết
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'blog'}">Bài viết</router-link></li>
                <li class="breadcrumb-item active">Tạo mới bài viết</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <slide-form @submit="formSubmit" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {createSlide} from  '../../api/slide'
import SlideForm from './SlideForm'
export default {
    components: {
        SlideForm
    },
    methods: {
        formSubmit(slide) {
            createSlide(slide)
            .then(response => {
                $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm slide thành công.')
                this.$router.push({ name: 'slide'})
            }).catch( error => {
                if(error && error.errors && error.errors.title) {
                    error.errors.title.forEach(function(errTitle) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errTitle)
                    })
                }
            })
        }
    }
}
</script>

<style scoped>
.upload.has-image input{
    display: none;
}
.upload label{
    display: block;
    text-align: center;
}
.upload img{
    max-width: 80%;
}
</style>