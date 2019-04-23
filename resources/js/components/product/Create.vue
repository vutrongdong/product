<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Tạo mới sản phẩm
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'product'}">Sản phẩm</router-link></li>
                <li class="breadcrumb-item active">Tạo mới sản phẩm</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <product-form @submit="formSubmit" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {createProduct} from  '../../api/product'
import ProductForm from './ProductForm'
export default {
    components: {
        ProductForm
    },
    methods: {
        formSubmit(product) {
            createProduct(product)
            .then(response => {
                $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm dữ liệu thành công.')
                this.$router.push({ name: 'product'})
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

                if(error && error.errors && error.errors.code) {
                    error.errors.code.forEach(function(errCode) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errCode)
                    })
                }
            })
        }
    }
}
</script>
