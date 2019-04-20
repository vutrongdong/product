<template>
    <div class="row">
        <div class="col-12">
            <div class="btn-group pull-right m-t-15">
                <router-link :to="{ name: 'category.create'}" class="btn btn-default waves-effect waves-light">Thêm mới danh mục</router-link>
            </div>
            <h4 class="page-title">
                Danh mục
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Danh mục</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-header">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." @keydown="filter()">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Slug</th>
                                        <th>Danh mục cha</th>
                                        <th style="padding-left: 19px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(category, idx) in allCategories" :key="category.id">
                                        <td>{{ ++idx }}</td>
                                        <td>{{ category.title }}</td>
                                        <td>{{ category.slug }}</td>
                                        <td v-if="category.parent">{{ category.parent.title }}</td>
                                        <td v-else></td>
                                        <td>
                                            <router-link class="btn btn-link btn-action text-muted" :to="{name: 'category.edit', params: {id: category.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                                            <a class="btn btn-link btn-action text-danger" @click="deleteCategory(category.id)"><i class="fas fa-trash-alt"></i></a>
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
import { getCategories, removeCategory } from  '../../api/categories'
export default {
    data () {
        return {
            allCategories: []
        }
    },
    methods: {
        deleteCategory (id) {
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
                removeCategory(id)
                .then(response => {
                    this.fetchCategory();
                }).catch( error => {
                    console.log(error)
                })
              }
            })
        },
        fetchCategory() {
            getCategories()
            .then(response => {
                this.allCategories = response;
            }).catch( error => {
            })
        }
    },
    created() {
        this.fetchCategory();
    }
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
