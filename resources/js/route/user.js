import users from '../components/user/Index';
import ResetPassword from '../components/user/ResetPassword';
export default [
    {
        path: '/admin/users',
        name: 'user',
        component: users
    },
    {
        path: '/admin/users/reset_password',
        name: 'reset',
        component: ResetPassword
    },
];
