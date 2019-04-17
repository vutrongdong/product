import Category from '../components/category/Index';
import NewCategory from '../components/category/Create';
import EditCategory from '../components/category/Edit';

export default [
    {
        path: '/admin/categories',
        name: 'category',
        component: Category
    },
    {
        path: '/admin/categories/create',
        name: 'category.create',
        component: NewCategory
    },
    {
        path: '/admin/categories/edit/:id',
        name: 'category.edit',
        component: EditCategory
    }
];
