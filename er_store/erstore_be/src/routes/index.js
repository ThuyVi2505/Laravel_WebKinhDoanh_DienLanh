const brand = require('./brand.route');
const category = require('./category.route')
const user = require('./user.route')

const apiURL = '/api/v1';

const initRouter = (app) =>{
    // authentication
    // - user
    app.use(apiURL+'/user',user);

    // BRANDS
    app.use(apiURL+'/brand',brand);

    // CATEGORY
    app.use(apiURL+'/category', category);
    // test
    app.use('/', (req, res) => {
        res.send('server on...')
    });
}
module.exports = initRouter;