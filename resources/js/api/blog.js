import {apiRequest} from './apiRequest'
import {COMULE_CONST} from '../constant'

const getBlog = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/blog/' + id, COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const getBlogs = (params) => {
    let page = params.params.page;
    let q = params.params.q;
    if(q) {
        page = '';
    }
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/blogs?q='+ q + '&page='+ page, COMULE_CONST.api_method.get, params)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const removeBlog = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/blog/' + id, COMULE_CONST.api_method.delete)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const createBlog = (data) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/blog/create/', COMULE_CONST.api_method.post, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const updadeBlog = (blog) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/blog/update/' + blog.id, COMULE_CONST.api_method.put, blog)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};


export { getBlog, getBlogs, createBlog, removeBlog, updadeBlog }
