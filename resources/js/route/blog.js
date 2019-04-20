import Blog from '../components/blog/Index';
import NewBlog from '../components/blog/Create';
import EditBlog from '../components/blog/Edit';
// import DetailBlog from '../unexpected/components/Detail';

export default [
    {
        path: '/admin/blogs',
        name: 'blog',
        component: Blog
    },
    {
        path: '/admin/blog/create',
        name: 'blog.create',
        component: NewBlog
    },
    {
        path: '/admin/blog/edit/:id',
        name: 'blog.edit',
        component: EditBlog
    }
];
