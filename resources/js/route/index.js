import Vue from 'vue';
import Router from 'vue-router';
import adminHome from './adminHome.js';
import categories from './categories.js';
import product from './product.js';
import blog from './blog.js';
import user from './user.js';
import slide from './slide.js';

export default [
    ...adminHome,
    ...categories,
    ...product,
    ...user,
    ...slide,
    ...blog
];
