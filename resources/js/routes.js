  
import AllBooks from './components/AllBooks.vue';
import CreateBook from './components/CreateBook.vue';
import NotFound from './components/404.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllBooks
    },
    {
        name: 'create',
        path: '/create/',
        component: CreateBook
    },
    {
        name: '404',
        path: '*',
        component: NotFound
    }
];