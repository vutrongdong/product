import {apiRequest} from './apiRequest'
import {COMULE_CONST} from '../constant'

const getCategories = () => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/categories/', COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const getCategory = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/category/' + id, COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const getCategoriesForSelect = (diffIdCurent) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/categories/parent/' + diffIdCurent, COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const getCategoriesForBlog = () => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/categories/blog/', COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const getCategoriesForMenu = () => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/categories/children/', COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};


const createCategory = (data) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/category/create', COMULE_CONST.api_method.post, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const updadeCategory = (data) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/category/update/'+ data.id, COMULE_CONST.api_method.put, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const removeCategory = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/category/' + id, COMULE_CONST.api_method.delete)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};


export { getCategories, getCategoriesForSelect, getCategoriesForMenu,
 createCategory, removeCategory, getCategory, updadeCategory,
 getCategoriesForBlog }
