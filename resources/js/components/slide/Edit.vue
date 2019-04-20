<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Chỉnh sửa Slide
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'slide'}">Slide</router-link></li>
                <li class="breadcrumb-item active">Chỉnh sửa slide</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <slide-form v-if="slide.id" @submit="formSubmit" type="edit" :dataSlide="slide" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import SlideForm from './SlideForm'
import { getSlide, updadeSlide } from  '../../api/slide'
export default {
    components: {
        SlideForm
    },
    data () {
        return {
            slide: {},
        }
    },
    methods: {
        formSubmit(slide) {
            updadeSlide(slide)
            .then(response => {
                $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Sửa slide thành công.')
                this.$router.push({ name: 'slide'})
            }).catch( error => {
                if(error && error.errors && error.errors.title) {
                    error.errors.title.forEach(function(errTitle) {
                        $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', errTitle)
                    })
                }
            })
        },
        fetchSlide() {
            getSlide(this.$route.params.id)
            .then(response => {
                this.slide = response;
            }).catch( err => {
                console.log(err);
            })
        }
    },
    created() {
        this.fetchSlide();
    }
}
</script>
