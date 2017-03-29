function iotWsConnect() {

    if ("WebSocket" in window) {
        var requestUrl = genUrl();
        console.log('------------------');
        console.log('requestUrl ' + requestUrl);

        var clientId = "adsfar2348fhdsfjklqpOEU38";
        var client = new Paho.MQTT.Client(requestUrl, clientId);

        var topic = "poc_policy_1";
        // var message = '{"time": "'+ $("#time_stamp").val() +'", "state": "'+ $("#state").val() +'"}';
        var time = $("#time_stamp").val().toString();
        var state = $("#state").val().toString();
        var message = '{"time": "' + time + '", "state": "' + state + '"}';

        var connectOptions = {
            onSuccess: function () {
                console.log('wss connection success');
                console.log(client);
                client.send(topic, message);
            },
            useSSL: true,
            timeout: 3,
            mqttVersion: 4,
            onFailure: function () {
                console.log('wss connection failed');
            }
        };
        client.connect(connectOptions);
    }
}



function SigV4Utils() {}

SigV4Utils.sign = function (key, msg) {
    var hash = CryptoJS.HmacSHA256(msg, key);
    return hash.toString(CryptoJS.enc.Hex);
};

SigV4Utils.sha256 = function (msg) {
    var hash = CryptoJS.SHA256(msg);
    return hash.toString(CryptoJS.enc.Hex);
};

SigV4Utils.getSignatureKey = function (key, dateStamp, regionName, serviceName) {
    var kDate = CryptoJS.HmacSHA256(dateStamp, 'AWS4' + key);
    var kRegion = CryptoJS.HmacSHA256(regionName, kDate);
    var kService = CryptoJS.HmacSHA256(serviceName, kRegion);
    var kSigning = CryptoJS.HmacSHA256('aws4_request', kService);
    return kSigning;
};

function genUrl() {

    var time = moment.utc();
    var dateStamp = time.format('YYYYMMDD');
    var amzdate = dateStamp + 'T' + time.format('HHmmss') + 'Z';
    var service = 'iotdevicegateway';
    var region = 'us-east-1';
    var secretKey = '71hA/coZ7pqv4tneE83CVSnWQPQYdeTvyG5rs3pF';
    var accessKey = 'AKIAIIGNXQDDNHJRYAFA';
    var algorithm = 'AWS4-HMAC-SHA256';
    var method = 'GET';
    var canonicalUri = '/mqtt';
    var host = 'a1hh5pweejj7gx.iot.us-east-1.amazonaws.com';

    var credentialScope = dateStamp + '/' + region + '/' + service + '/' + 'aws4_request';
    var canonicalQuerystring = 'X-Amz-Algorithm=AWS4-HMAC-SHA256';
    canonicalQuerystring += '&X-Amz-Credential=' + encodeURIComponent(accessKey + '/' + credentialScope);
    canonicalQuerystring += '&X-Amz-Date=' + amzdate;
    canonicalQuerystring += '&X-Amz-Expires=86400';
    canonicalQuerystring += '&X-Amz-SignedHeaders=host';

    var canonicalHeaders = 'host:' + host + '\n';
    var payloadHash = SigV4Utils.sha256('');
    var canonicalRequest = method + '\n' + canonicalUri + '\n' + canonicalQuerystring + '\n' + canonicalHeaders + '\nhost\n' + payloadHash;
    console.log('canonicalRequest ' + canonicalRequest);

    var stringToSign = algorithm + '\n' + amzdate + '\n' + credentialScope + '\n' + SigV4Utils.sha256(canonicalRequest);
    var signingKey = SigV4Utils.getSignatureKey(secretKey, dateStamp, region, service);
    console.log('stringToSign-------');
    console.log(stringToSign);
    console.log('------------------');
    console.log('signingKey ' + signingKey);
    var signature = SigV4Utils.sign(signingKey, stringToSign);

    canonicalQuerystring += '&X-Amz-Signature=' + signature;
    var requestUrl = 'wss://' + host + canonicalUri + '?' + canonicalQuerystring;
    return requestUrl;

}
