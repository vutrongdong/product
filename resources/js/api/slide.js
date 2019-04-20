import {apiRequest} from './apiRequest'
import {COMULE_CONST} from '../constant'

const getSlide = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/slide/' + id, COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const getSlides = () => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/slides/', COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const removeSlide = (id) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/slide/' + id, COMULE_CONST.api_method.delete)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const createSlide = (data) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/slide/create/', COMULE_CONST.api_method.post, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const updadeSlide = (slide) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/slide/update/' + slide.id, COMULE_CONST.api_method.put, slide)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};


export { getSlide, getSlides, createSlide, removeSlide, updadeSlide }
