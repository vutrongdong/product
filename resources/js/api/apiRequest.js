import axios from 'axios';
const apiRequest = (url, methodType, data = {}, multipart = false) => {
    let headers;
    headers = {};

    if (multipart) {
        headers['content-type'] = 'multipart/form-data';
    }
    console.log(headers)

    return new Promise(
        (resolve, reject) => {
            axios({
                method: methodType,
                url: url,
                data: data,
                headers: headers
            })
                .then(response => {
                    resolve(response.data);
                })
                .catch(function (error) {
                    console.log(error)
                    reject(error.response.data);
                });
        });
};


export {apiRequest}
