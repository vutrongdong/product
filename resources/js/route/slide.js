import slides from '../components/slide/Index';
import NewSlide from '../components/slide/Create';
import EditSlide from '../components/slide/Edit';

export default [
    {
        path: '/admin/slides',
        name: 'slide',
        component: slides
    },
    {
        path: '/admin/slide/create',
        name: 'slide.create',
        component: NewSlide
    },
    {
        path: '/admin/slide/edit/:id',
        name: 'slide.edit',
        component: EditSlide
    }
];
