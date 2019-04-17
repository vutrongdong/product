import Product from '../components/product/Index';
import NewProduct from '../components/product/Create';
import EditProduct from '../components/product/Edit';

export default [
    {
        path: '/admin/products',
        name: 'product',
        component: Product
    },
    {
        path: '/admin/products/create',
        name: 'product.create',
        component: NewProduct
    },
    {
        path: '/admin/products/edit/:id',
        name: 'product.edit',
        component: EditProduct
    }
];
