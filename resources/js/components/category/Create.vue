<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Tạo mới danh mục
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'category'}">Danh mục</router-link></li>
                <li class="breadcrumb-item active">Tạo mới danh mục</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <category-form @submit="formSubmit" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { debounce } from 'lodash'
import CategoryForm from './CategoryForm'
import {createCategory} from  '../../api/categories'
export default {
    components: {
        CategoryForm
    },
    methods: {
        formSubmit(category) {
            createCategory(category)
            .then(response => {
                $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm dữ liệu thành công.')
                this.$router.push({ name: 'category'})
            }).catch( error => {
                if(error && error.errors && error.errors.title) {
                    error.errors.title.forEach(function(errTitle) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errTitle)
                    })
                }

                if(error && error.errors && error.errors.slug) {
                    error.errors.slug.forEach(function(errSlug) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errSlug)
                    })
                }
            })
        }
    }
}
</script>
