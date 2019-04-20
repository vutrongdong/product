<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Chỉnh sửa bài viết
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'blog'}">Bài viết</router-link></li>
                <li class="breadcrumb-item active">Chỉnh sửa bài viết</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <blog-form v-if="blog.id" @submit="formSubmit" type="edit" :dataBlog="blog" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { cloneDeep } from 'lodash'
import BlogForm from './BlogForm'
import { getBlog, updadeBlog } from  '../../api/blog'
export default {
    components: {
        BlogForm
    },
    data () {
        return {
            blog: {}
        }
    },
    methods: {
        formSubmit(blog) {
            updadeBlog(blog)
            .then(response => {
                $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm dữ liệu thành công.')
                this.$router.push({ name: 'blog'})
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

                if(error && error.errors && error.errors.content) {
                    error.errors.content.forEach(function(errContent) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errContent)
                    })
                }

                if(error && error.errors && error.errors.teaser) {
                    error.errors.teaser.forEach(function(errTeaser) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errTeaser)
                    })
                }
            })
        }
    },
    created () {
        getBlog(this.$route.params.id)
            .then(response => {
                this.blog = response;
            }).catch( err => {
                console.log(err);
            })
    }
}
</script>
