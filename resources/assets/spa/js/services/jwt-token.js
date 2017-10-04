import {Jwt} from "./resources";
import LocalStorage from "./localStorage";

const TOKEN = 'token';
const PUSH = 'pusherTransportUnencrypted';

export default {
    get token(){
        return LocalStorage.get(TOKEN);
    },
    set token(value){
        return value ? LocalStorage.set(TOKEN, value) : LocalStorage.remove(TOKEN);
    },
     set tokenPushe(value){
        return value ? LocalStorage.set(TOKEN, value) : LocalStorage.remove(PUSH);
    },
    _events: {
        'updateToken': []
    },
    accessToken(email,password){
        return Jwt.accessToken(email, password).then((response)=>{
console.log(response);
            this.token = response.data.token;
           // this._callEventUpdateToken(this.token);
            return response;
        });
    },
    refreshToken(){
        return Jwt.refreshToken().then((response) => {
            this.token = response.data.token;
            //this._callEventUpdateToken(this.token);
            return response;
        });
    },
    revokeToken(){
        let afterReveokeToken = (response) => {
            this.token = null;
            this.tokenPushe = null;
            return response;
        };

        return Jwt.logout().
            then(afterReveokeToken)
            .catch(afterReveokeToken);
    },
    getAuthorizationHeader(){
        return `Bearer ${LocalStorage.get(TOKEN)}`;
    },
    event(name, callback){
        this._events[name].push(callback);
    },
    _callEventUpdateToken(value){
        for(let callback of this._events['updateToken']){
            callback(value);
        }
    }
}