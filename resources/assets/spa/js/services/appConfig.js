import config from '../config';

let localConfig = {
	test: 'tese'
};

const appConfig = Object.assign({}, config, localConfig );

export default appConfig;