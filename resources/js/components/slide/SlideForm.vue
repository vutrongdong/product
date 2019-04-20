<template>
    <div>
    	<form class="form" role="form" @submit.prevent="formSubmit">
            <p class="clearfix"></p>
	        <div class="form-group">
		        <label class="text-right" for="title">Tiêu đề (<span class="text-danger">*</span>)</label>
		        <input type="text" id="title" :class="{'form-control' : true, 'is-invalid': errors.has('title')}" placeholder="Nhập tên" v-model="slide.title" name="title" v-validate="'required'" data-vv-as="họ tên">
		        <div v-show="errors.has('title')" class="text-danger">{{ errors.first('title') }}</div>
		    </div>
		    <div class="form-group">
                <label class="text-right" for="image">Ảnh (<span class="text-danger">*</span>)</label>
                <div class="upload" :class="{'has-image': slide.image}">
                    <label>
                        <input v-validate="valid_image" class="form-control" id="image" type="file" name="image" @change="handerSelectImage" :class="{'form-control' : true, 'is-invalid': errors.has('image')}" data-vv-as="Hình ảnh">
                        <img width="100%" style="margin-top:5px;" v-if="slide.image" :src="slide.image_path" />
                    </label>
                </div>
                <div v-show="errors.has('image')" class="text-danger">{{ errors.first('image') }}</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-default" type="submit"><span v-if="this.type === 'create'">Tạo Slide</span><span v-else>Lưu lại</span></button>
                    <router-link v-if="type !== 'modal'" :to="{ name: 'slide'}" class="btn btn-link">Trở lại</router-link>
                </div>
            </div>
		</form>
    </div>
</template>
<script>
export default {
    name: 'SlideForm',
    props: {
        type: {
            type: String,
            default: 'create'
        },
        dataSlide: {
            type: Object,
            default: () => {
                return {
                    title: null,
                    image: null,
                }
            }
        }
    },
    data() {
        return {
            slide: {
                title: null,
                image: null,
            }
        }
    },
    methods: {
    	setInitData() {
            let dataSlide = { ...this.dataSlide }
            this.slide = { ...this.slide,
                ...dataSlide
            }
        },
    	async handerSelectImage (evt) {
            if (evt.target.files[0]) {
                let formData = new FormData()
                formData.append('file', evt.target.files[0])
                try {
                    let response = await axios.post('/api/slides/upload', formData, {params: {resize: 1, imageOld: this.slide.image }})
                    if (response.data.code === 1) {
                        this.slide.image = response.data.data.name
                        this.slide.image_path = response.data.data.path
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
        formSubmit () {
            this.$validator.validate().then(result => {
                if (result) {
                    let slide = Object.assign({}, this.slide)
                    this.$emit('submit', slide)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', 'Vui lòng kiểm tra thông tin cần nhập')
                }
            })
        }
    },
    computed: {
        valid_image() {
            return this.$route.params.id ? '' : 'required'
        }
    },
    created() {
    	this.setInitData()
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
</style>
