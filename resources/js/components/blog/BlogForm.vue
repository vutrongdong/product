<template>
    <div>
        <form class="form" role="form" @submit.prevent="formSubmit">
            <p class="clearfix"></p>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-right" for="title">Tiêu đề (<span class="text-danger">*</span>)</label>
                        <input type="text" id="title" :class="{'form-control' : true, 'is-invalid': errors.has('title')}" placeholder="Nhập tên" v-model="blog.title" name="title" v-validate="'required'" data-vv-as="họ tên" @keydown="generateSlug" @change="generateSlug" @keyup="generateSlug">
                        <div v-show="errors.has('title')" class="text-danger">{{ errors.first('title') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="text-right" for="slug">Slug (<span class="text-danger">*</span>)</label>
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Nhập slug" v-model="blog.slug" v-validate="'required'" data-vv-as="slug" :class="{'form-control' : true, 'is-invalid': errors.has('slug')}">
                        <div v-show="errors.has('slug')" class="text-danger">{{ errors.first('slug') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="text-right" for="category_id">Chọn danh mục(<span class="text-danger">*</span>)</label>
                        <select class="form-control" v-validate="'required'" name="category_id" data-vv-as="danh mục cha" id="category_id" v-model="blog.category_id" :class="{'form-control' : true, 'is-invalid': errors.has('category_id')}">
                            <option :value="null">Chọn danh mục</option>
                            <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.title }}</option>
                        </select>
                        <div v-show="errors.has('category_id')" class="text-danger">{{ errors.first('category_id') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="text-right">Trạng thái</label>
                        <div class="checkbox checkbox-success">
                            <input id="active" v-model="blog.active" type="checkbox">
                            <label for="active" v-if="blog.active">
                                Hiển thị
                            </label>
                            <label for="active" v-else>
                                Không hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-right" for="teaser">Mô tả ngắn</label>
                        <textarea rows="11" id="teaser" class="form-control" v-model="blog.teaser" placeholder="Mô tả ngắn"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="text-right" for="image">Ảnh (<span class="text-danger">*</span>)</label>
                        <div class="upload" :class="{'has-image': blog.image}">
                            <label>
                                <input v-validate="valid_image" class="form-control" id="image" type="file" name="image" @change="handerSelectImage" :class="{'form-control' : true, 'is-invalid': errors.has('image')}" data-vv-as="Hình ảnh">
                                <img v-if="blog.image" :src="blog.image_path" />
                            </label>
                        </div>
                        <div v-show="errors.has('image')" class="text-danger">{{ errors.first('image') }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="text-right" for="content">Nội dung</label>
                        <tinymce
                            id="content"
                            :plugins="plugins"
                            v-model="blog.content"
                            :class="{'is-invalid': errors.has('image')}"
                            :error-messages="errors.has('content') ? errors.collect('content') : []"
                            toolbar1="formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | codesample"
                            toolbar2=""
                            :other_options="{ height: '300px', images_upload_handler: handleImageAdded }"
                            @editorInit="e => e.setContent(blog.content ? blog.content : '')"
                        ></tinymce>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-default" type="submit"><span v-if="this.type === 'create'">Tạo bài viết</span><span v-else>Lưu lại</span></button>
                    <router-link v-if="type !== 'modal'" :to="{ name: 'blog'}" class="btn btn-link">Trở lại</router-link>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import { debounce, findIndex } from 'lodash'
import { getCategoriesForBlog } from  '../../api/categories'
import tinymce from 'vue-tinymce-editor'
export default {
    name: 'BlogForm',
    components: {
        tinymce,
    },
    props: {
        type: {
            type: String,
            default: 'create'
        },
        dataBlog: {
            type: Object,
            default: () => {
                return {
                    title: null,
                    slug: null,
                    image: null,
                    teaser: null,
                    content: null,
                    active: true,
                    category_id: null,
                }
            }
        }
    },
    data() {
        return {
            blog: {
                title: null,
                slug: null,
                image: null,
                teaser: null,
                content: null,
                active: true,
                category_id: null,
            },
            categories: [],
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor codesample"
            ],
            newTagForm: false
        }
    },
    computed: {
        valid_image() {
            return this.$route.params.id ? '' : 'required'
        }
    },
    methods: {
        generateSlug () {
            this.blog.slug = this.stringToSlug(this.blog.title)
        },
        fetchCategoriesForSelect () {
            getCategoriesForBlog()
            .then(response => {
                this.categories = response;
            }).catch( error => {
            })
        },

        stringToSlug(str)
        {
            var slug
            str = str ? str : ''
            //Đổi chữ hoa thành chữ thường
            slug = str.toLowerCase()

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
            slug = slug.replace(/đ/gi, 'd')
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\|_/gi, '')
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-")
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-')
            slug = slug.replace(/\-\-\-\-/gi, '-')
            slug = slug.replace(/\-\-\-/gi, '-')
            slug = slug.replace(/\-\-/gi, '-')
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@'
            slug = slug.replace(/\@\-|\-\@|\@/gi, '')
            return slug
        },

        async handerSelectImage (evt) {
            if (evt.target.files[0]) {
                let formData = new FormData()
                formData.append('file', evt.target.files[0])
                try {
                    let response = await axios.post('/api/blogs/upload', formData, {params: {resize: 1, imageOld: this.blog.image }})
                    if (response.data.code === 1) {
                        this.blog.image = response.data.data.name
                        this.blog.image_path = response.data.data.path
                    } else {
                        $.Notification.autoHideNotify('error', 'top right', 'Lỗi', 'Upload file thất bại')
                    }
                } catch(err) {
                    if (err.status == 422) {
                        let msg = []
                        forIn(err.data, (err, idx) => {
                            msg.push("&bullet; " + err[0])
                        })
                        $.Notification.autoHideNotify('error', 'top right', 'Thất bại', msg.join("<br>"))
                    } else {
                        $.Notification.autoHideNotify('error', 'top right', 'Lỗi', 'Upload file thất bại')
                    }
                }
            }
        },

        handleImageAdded: async function (file, success, failure) {
          let formData = new FormData()
          formData.append('file', file.blob())
          try{
              let response = await axios.post('/api/blogs/upload', formData)
              if (response.data.code === 1) {
                success(response.data.data.path)
              } else {
                return false
              }
          } catch (err) {
            if (err.status == 422) {
                let msg = []
                forIn(err.data, (err, idx) => {
                    msg.push("&bullet; " + err[0])
                })
                $.Notification.autoHideNotify('error', 'top right', 'Thất bại', msg.join("<br>"))
            }
          }
        },

        formSubmit () {
            this.$validator.validate().then(result => {
                if (result) {
                    let blog = Object.assign({}, this.blog)
                    this.$emit('submit', blog)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', 'Vui lòng kiểm tra thông tin cần nhập')
                }
            })
        }
    },
    created () {
        this.blog = Object.assign({}, this.blog, this.dataBlog)
        this.fetchCategoriesForSelect()
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
.label{
    margin: 2px;
    white-space: normal;
}
</style>
