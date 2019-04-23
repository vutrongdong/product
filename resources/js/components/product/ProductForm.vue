<template>
    <div>
        <form class="form" role="form" @submit.prevent="formSubmit">
            <p class="clearfix"></p>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-right" for="title">Tên sản phẩm (<span class="text-danger">*</span>)</label>
                        <input type="text" id="title" :class="{'form-control' : true, 'is-invalid': errors.has('title')}" placeholder="Nhập tên" v-model="product.title" name="title" v-validate="'required'" data-vv-as="họ tên" @keydown="generateSlug" @change="generateSlug" @keyup="generateSlug">
                        <div v-show="errors.has('title')" class="text-danger">{{ errors.first('title') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="text-right" for="slug">Slug (<span class="text-danger">*</span>)</label>
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Nhập slug" v-model="product.slug" v-validate="'required'" data-vv-as="slug" :class="{'form-control' : true, 'is-invalid': errors.has('slug')}">
                        <div v-show="errors.has('slug')" class="text-danger">{{ errors.first('slug') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="text-right" for="code"> Mã sản phẩm (<span class="text-danger">*</span>)</label>
                        <input type="text" id="code" name="code" class="form-control" placeholder="Nhập mã" v-model="product.code" v-validate="'required'" data-vv-as="mã sản phầm" :class="{'form-control' : true, 'is-invalid': errors.has('code')}">
                        <div v-show="errors.has('code')" class="text-danger">{{ errors.first('code') }}</div>
                    </div>
                    <div class="row">
                    	<div class="col-6">
                            <label class="text-right" for="category"> Danh mục cha (<span class="text-danger">*</span>)</label>
                            <div class="clearFic"></div>
                            <multi-select
                              id="category"
                              v-model="product.category"
                              :options="options"
                              v-validate="'required'"
                              :class="{'form-control' : true, 'is-invalid': errors.has('code')}"
                              data-vv-as="danh mục"
                              :selectOptions="categories"
                              :btnLabel="btnLabel" />
                            <div v-show="errors.has('category')" class="text-danger">{{ errors.first('category') }}</div>
                        </div>
                        <div class="col-6">
							<label class="text-right" for="price"> Giá bán (<span class="text-danger">*</span>)</label>
							<input type="number" id="price" name="price" class="form-control" placeholder="Nhập mã" v-model="product.price" v-validate="'required|numeric'" data-vv-as="giá bán" :class="{'form-control' : true, 'is-invalid': errors.has('price')}">
                    	</div>
                    </div>
                    <div class="form-group">
                        <label class="text-right" for="image" style="margin-top: 6px;">Ảnh (<span class="text-danger">*</span>)</label>
                        <div class="upload" :class="{'has-image': product.image}">
                            <label>
                                <input v-validate="valid_image" class="form-control" id="image" type="file" name="image" @change="handerSelectImage" :class="{'form-control' : true, 'is-invalid': errors.has('image')}" data-vv-as="Hình ảnh">
                                <img v-if="product.image" style="float:left" :src="product.image_path" />
                                <div class="clearfix"></div>
                            </label>
                        </div>
                        <div v-show="errors.has('image')" class="text-danger">{{ errors.first('image') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="text-right" for="note">Mô tả ngắn</label>
                        <textarea rows="12" id="note" class="form-control" v-model="product.note" placeholder="Mô tả ngắn"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Trạng thái</label>
                            <div class="checkbox checkbox-success">
                                <input id="active" v-model="product.active" type="checkbox">
                                <label for="active" v-if="product.active">
                                    Hiển thị
                                </label>
                                <label for="active" v-else>
                                    Không hiển thị
                                </label>
                            </div>
                        </div>
                    	<div class="col-6">
	                        <label for="date">Chọn năm</label>
	                        <select class="form-control" v-validate="'required'" name="date" data-vv-as="danh mục cha" id="date" v-model="product.date" :class="{'form-control' : true, 'is-invalid': errors.has('date')}">
	                            <option :value="null">Chọn năm</option>
	                            <option v-for="(date, index) in dates" :value="index + 1" :key="'date' + date"> Năm {{ date }}</option>
	                        </select>
	                        <div v-show="errors.has('date')" class="text-danger">{{ errors.first('date') }}</div>
                    	</div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-default" type="submit"><span v-if="this.type === 'create'">Tạo sản phẩm</span><span v-else>Lưu lại</span></button>
                    <router-link v-if="type !== 'modal'" :to="{ name: 'product'}" class="btn btn-link">Trở lại</router-link>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import { debounce, findIndex } from 'lodash'
import { getCategoriesForProduct } from  '../../api/categories'
import multiSelect from 'vue-multi-select';
import 'vue-multi-select/dist/lib/vue-multi-select.min.css';
export default {
    name: 'ProductForm',
    components: {
        multiSelect
    },
    props: {
        type: {
            type: String,
            default: 'create'
        },
        dataProduct: {
            type: Object,
            default: () => {
                return {
                    title: null,
                    slug: null,
                    code: null,
                    image: null,
                    note: null,
                    date: null,
                    active: true,
                    category: [],
                }
            },
        }
    },
    data() {
        return {
            product: {
                title: null,
                slug: null,
                code: null,
                image: null,
                date: null,
                note: null,
                active: true,
                category: [],
            },
            categories: [],
            dates: [],
            options: {
		        renderTemplate(elem) { return `${elem.title}`; },
		        multi: true
		     },
		    btnLabel: 'Danh mục đã chọn',
        }
    },
    computed: {
        valid_image() {
            return this.$route.params.id ? '' : 'required'
        }
    },
    methods: {
        generateSlug () {
            this.product.slug = this.stringToSlug(this.product.title)
        },
        fetchCategoriesForSelect () {
            getCategoriesForProduct()
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
                    let response = await axios.post('/api/products/upload', formData, {params: {resize: 1, imageOld: this.product.image }})
                    if (response.data.code === 1) {
                        this.product.image = response.data.data.name
                        this.product.image_path = response.data.data.path
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
        generateYear() {
             let start_year = new Date().getFullYear();
             for (var i = 1990; i <= start_year; i++) {
			    this.dates.push(i);
			 }
        },
        formSubmit () {
            this.$validator.validate().then(result => {
                if (result) {
                    let product = Object.assign({}, this.product)
                    this.$emit('submit', product)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', 'Vui lòng kiểm tra thông tin cần nhập')
                }
            })
        }
    },
    created () {
        this.product = Object.assign({}, this.product, this.dataproduct)
        this.fetchCategoriesForSelect()
        this.generateYear();
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
<style>
	#category .btn-select {
        border: none;
		margin-top: -2px;
        margin-left: -9px;
    	height: 18px;
	}
    #category .margin-left-20[data-v-1604b90e] {
    margin-left: 9px;
}
</style>
