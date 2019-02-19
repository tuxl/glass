import index from '../components/index/index';
import listproduction from '../components/productionllist/index';
import catlist from '../components/catlist/index';

const routes = [
    { path: '/', component: index },
    { path: '/listproduction', component: listproduction },
    { path: '/catlist', component: catlist },
];

export { routes };