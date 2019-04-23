<template>
    <div class="row">
        <div class="col-12">
            <div class="btn-group pull-right m-t-15">
                <router-link :to="{ name: 'product.create'}" class="btn btn-default waves-effect waves-light">Thêm mới sản phẩm</router-link>
            </div>
            <h4 class="page-title">
                Sản phẩm
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Sản phẩm</li>
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
                                        <th>Tên sản phẩm</th>
                                        <th>Mã</th>
                                        <th>Giá bán</th>
                                        <th>Hiển thị</th>
                                        <th style="padding-left: 19px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(product, idx) in allProducts.data" :key="product.id">
                                        <td>{{ ++idx }}</td>
                                        <td>{{ product.title }}</td>
                                        <td>{{ product.code }}</td>
                                        <td>{{ product.price }}</td>
                                        <td><i class="fa fa-check text-success" v-if="product.active"></i></td>
                                        <td>
                                            <router-link class="btn btn-link btn-action text-muted" :to="{name: 'product.edit', params: {id: product.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                                            <a class="btn btn-link btn-action text-danger" @click="deleteProduct(product.id)"><i class="fas fa-trash-alt"></i></a>
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
import { getProducts, removeProduct } from  '../../api/product';
export default {
    data () {
        return {
            filters: {
                q: '',
                page: ''
            },
            allProducts: []
        }
    },
    methods: {
        paginationChange (page) {
            this.filters.page = page
            this.filter()
        },

        filter: debounce(function () {
            this.fetchProducts()
        }, 500),
        fetchProducts() {
            getProducts({params: this.filters})
            .then(response => {
                this.allProducts = response;
            }).catch( err => {
                console.log(err);
            })
        },
        deleteProduct (id) {
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
                removeProduct(id)
                .then(response => {
                    this.fetchBlogs()
                }).catch( err => {
                    console.log(err);
                })
                this.filter()
              }
            })
        }
    },

    created() {
        this.fetchProducts()
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
