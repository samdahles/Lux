const $ = require('jquery');

class JSONRequest {
    static get(url, options={}) {
        return this._request(url, 'GET', options);
    }

    static put(url, options={}) {
        return this._request(url, 'PUT', options);
    }

    static delete(url, options={}) {
        return this._request(url, 'DELETE', options);
    }

    static post(url, options={}) {
        return this._request(url, 'POST', options);
    }

    static head(url, options={}) {
        return this._request(url, 'HEAD', options);
    }

    static _request(url, method, data) {
        return $.ajax({
            dataType: 'json',
            url: url,
            data: data,
            type: method,
            async: false
        }).responseJSON;
    }
}

export default JSONRequest;