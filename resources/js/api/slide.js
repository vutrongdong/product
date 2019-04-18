import {apiRequest} from './apiRequest'
import {COMULE_CONST} from '../constant'

const getSlide = () => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/slide/', COMULE_CONST.api_method.get)
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


export { getSlide, createSlide }
