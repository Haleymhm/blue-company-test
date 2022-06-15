const Home = () => import('./component/Home.vue');

//Componentes de Categoria
const MostrarCat = () => import('./component/category/Mostrar.vue');
const CrearCat = () => import('./component/category/Crear.vue');
const EditarCat = () => import('./component/category/Editar.vue');


export const routes = [
    {
        name: 'home',
        path: '/home',
        component: Home
    },

    {
        name: 'mostrarCat',
        path: '/categories',
        component: MostrarCat
    },

    {
        name: 'CrearCat',
        path: '/crearcat',
        component: CrearCat
    },

    {
        name: 'editarrCat',
        path: '/editarcat/:id',
        component: MostrarCat
    }
];