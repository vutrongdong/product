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
                    <product-form v-if="blog.id" @submit="formSubmit" type="edit" :dataBlog="blog" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
import { cloneDeep } from 'lodash'
import ProductForm from './ProductForm'
export default {
    components: {
        ProductForm
    },
    data () {
        return {
            blog: {}
        }
    },
    methods: {
        ...mapActions(['pushBlog', 'getBlog']),
        formSubmit(blog) {
            this.pushBlog({
                blog: blog,
                cb: () => {
                    $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Cập nhật dữ liệu thành công.')
                    this.$router.push({ name: 'blog'})
                }
            })
        }
    },
    mounted() {
        this.getBlog({
            id: this.$route.params.id,
            cb: (blog) => {
                this.blog = Object.assign({}, this.blog, cloneDeep(blog))
            }
        })
    }
}
</script>
