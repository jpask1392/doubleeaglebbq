// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*';

import login from './ajax/login';
import regsiter from'./ajax/register';

// Load scrpits
jQuery(document).ready(() => {
    login.init();
    regsiter.init();
});