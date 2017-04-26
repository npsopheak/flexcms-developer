/**
| crypt.js
| Description:
|     . Cryption libraries to generate encrypted data and key to send to server
|
**/

(function (app){
    app
        .service('CryptService', ['$http', function ($http) {
            var public_key = '-----BEGIN PUBLIC KEY-----\nMIIBITANBgkqhkiG9w0BAQEFAAOCAQ4AMIIBCQKCAQBzJg6en2ZhWYhwrzLAuz/r\nWVDukqKU5dEUJTdPxr/hYVpzuZOSisPHDT783uHDxvRTSeMciZEmP2/mNLQVPSRO\nwHrO1DGTFF0lFxyF9kYaTPzgvJrubcVXkvom2GWPrM89QOLqEoAj3MC7ufq0g+JT\n0uClJIy9iZn7EkXOFChq0q3VDsxP3qITwU93JORZHYATldt37T3UIwUIqpjA8pOm\nSvr6FEjCT2YxFO0kc+3vJyMn37QXRaQSi3EoCfX/GYxD0YgwVIj8Fs0V4uz+D3FU\nE5R9SbDWnqB2bB3TdQBRBEePmz1VSzfoAqONyKwgktT62ws6fv94Qo+QoKJ01Nfz\nAgMBAAE=\n-----END PUBLIC KEY-----';
            var public_method = {
                encryptKey: function (pass) {
                    var encrypt = new JSEncrypt();
                    encrypt.setPublicKey(public_key);
                    var encrypted = encrypt.encrypt(pass);

                    return encrypted;

                },
                generatePassword: function (length) {
                    length = length || 8;
                    var charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@!&%$#0123456789";
                    var retVal = "";
                    for (var i = 0, n = charset.length; i < length; ++i) {
                        retVal += charset.charAt(Math.floor(Math.random() * n));
                    }
                    return retVal;
                },
                encryptV2: function (text, pass) {
                    var encrypted = CryptoJS.AES.encrypt(text, pass);
                    return encrypted.toString();
                },

                decryptV2: function (text, pass) {
                    var decrypted = CryptoJS.AES.decrypt(text, pass);
                    return decrypted.toString(CryptoJS.enc.Utf8);
                },

                create: function (text, expired_in) {
                    var date = new Date();
                    var signature = date.getTime() + (expired_in * 1000 || (1000 * 60 * 10));
                    var pass = public_method.generatePassword(16);
                    text.signature = signature;
                    text = angular.isObject(text) ? angular.toJson(text) : text;
                    var en = public_method.encryptV2(text, pass);
                    var de = public_method.decryptV2(en, pass);
                    return {
                        pass: pass,
                        text: text,
                        encrypted: en,
                        decrypted: de,
                        encrypted_pass: public_method.encryptKey(pass)
                    };
                }
            };
            return public_method;
        }]);
}(app));