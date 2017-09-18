import Echo from 'laravel-echo';
import JwtToken from './services/jwt-token';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
   broadcaster: 'pusher',
   key: 'f855dc40aac8834f69d7'
});

const changeJwtTokenInEcho = value => {
   window.Echo.connector.pusher.config.auth.headers['Authorization'] =
       JwtToken.getAuthorizationHeader();
};

JwtToken.event('updateToken', value => {
   changeJwtTokenInEcho(value);
});

changeJwtTokenInEcho(JwtToken.token);