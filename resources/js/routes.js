  
import AllBooks from './components/AllBooks.vue';
import CreateBook from './components/CreateBook.vue';

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
];