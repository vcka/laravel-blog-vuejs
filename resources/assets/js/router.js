import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
function PageComponent(name) {
    return {
        render: h => h('h3', `Hello from the ${name} page`)
    };
}
export default new Router({
    mode: 'history',
    routes: [
        {path: 'admin/home', component: PageComponent(name), name: 'home'}
    ]
});