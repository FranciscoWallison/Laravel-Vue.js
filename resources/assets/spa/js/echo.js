import Echo from 'laravel-echo';
import JwtToken from './services/jwt-token';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'f855dc40aac8834f69d7',
    cluster: 'us2',
    encrypted: false
});

const changeJwtTokenInEcho = value => {//
   window.Echo.connector.pusher.config.auth.headers['Authorization'] =
       JwtToken.getAuthorizationHeader();// Bearer
};

JwtToken.event('updateToken', value => {
   changeJwtTokenInEcho(value);
});

changeJwtTokenInEcho(JwtToken.token);