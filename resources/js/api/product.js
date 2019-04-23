import {apiRequest} from './apiRequest'
import {COMULE_CONST} from '../constant'

const getProduct = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/product/' + id, COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const getProducts = (params) => {
    let page = params.params.page;
    let q = params.params.q;
    if(q) {
        page = '';
    }
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/products?q='+ q + '&page='+ page, COMULE_CONST.api_method.get, params)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const removeProduct = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/product/' + id, COMULE_CONST.api_method.delete)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const createProduct = (data) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/product/create/', COMULE_CONST.api_method.post, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const updadeProduct = (product) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/product/update/' + product.id, COMULE_CONST.api_method.put, product)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};


export { getProduct, getProducts, createProduct, removeProduct, updadeProduct }
