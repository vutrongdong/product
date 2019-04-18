import {apiRequest} from './apiRequest'
import {COMULE_CONST} from '../constant'

const getUsers = () => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/user/', COMULE_CONST.api_method.get)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};

const resetPassWord = (id, data) => {
    return new Promise(
        (resolve, reject) => {
            apiRequest('/api/user/reset_pass/'+ id, COMULE_CONST.api_method.put, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    reject(error);
                });
        }
    );
};


export { getUsers, resetPassWord }
