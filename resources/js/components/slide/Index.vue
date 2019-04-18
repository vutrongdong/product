<template>
    <div class="row">
        <div class="col-12">
            <div class="btn-group pull-right m-t-15">
                <router-link :to="{ name: 'slide.create'}" class="btn btn-default waves-effect waves-light">Thêm mới slide</router-link>
            </div>
            <h4 class="page-title">
                Slide
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Slide</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-header">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input v-model="filters.q" type="text" class="form-control" placeholder="Tìm kiếm..." @keydown="filter()">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tiêu đề</th>
                                        <th>Hình Ảnh</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>




                                    <tr v-for="(slide, idx) in allSlides" :key="'slide' + slide.id">
                                        <td>{{ ++idx }}</td>
                                        <td>{{ slide.title }}</td>
                                        <td><img src="" alt="slide"></td>
                                        <td>
                                            <router-link class="btn btn-link btn-action text-muted" :to="{name: 'slide.edit', params: {id: slide.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                                            <a class="btn btn-link btn-action text-danger" @click="deleteSlide(slide.id)"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { debounce } from 'lodash'
export default {
    data () {
        return {
            filters: {
                q: '',
                page: ''
            },
            allSlides: []
        }
    },
    methods: {
        deleteBlog (id) {
            swal({
              title: 'Cảnh báo?',
              text: "Bạn chắc chắn muốn xóa bản ghi này?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Xóa',
              cancelButtonText: 'Không',
              reverseButtons: true,
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger mr-2',
              buttonsStyling: false,
            }).then((result) => {
              if (result) {
                // this.removeBlog(id)
                // this.filter()
              }
            })
        }
    },
}
</script>

<style scoped>
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
</style>
