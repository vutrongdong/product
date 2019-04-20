<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Chỉnh sửa danh mục
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'category'}">Danh mục</router-link></li>
                <li class="breadcrumb-item active">Chỉnh sửa danh mục</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <category-form v-if="category.id" @submit="formSubmit" type="edit" :dataCategory="category" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { debounce } from 'lodash'
import CategoryForm from './CategoryForm'
import { getCategory, updadeCategory } from  '../../api/categories'
export default {
    components: {
        CategoryForm
    },
    data () {
        return {
            category: {}
        }
    },
    methods: {
        formSubmit(category) {
            updadeCategory(category)
            .then(response => {
                $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Sửa category thành công.')
                this.$router.push({ name: 'category'})
            }).catch( error => {
                if(error && error.errors && error.errors.title) {
                    error.errors.title.forEach(function(errTitle) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errTitle)
                    })
                }

                if(error && error.errors && error.errors.title) {
                    error.errors.title.forEach(function(errTitle) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errTitle)
                    })
                }
            })
        },
        fetchCategory() {
            getCategory(this.$route.params.id)
            .then(response => {
                this.category = response;
            }).catch( err => {
                console.log(err);
            })
        }
    },
    created() {
        this.fetchCategory();
    }
}
</script>
