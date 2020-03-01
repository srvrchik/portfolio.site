import Index from "../../pages/portfolio/Index";
import Create from "../../pages/portfolio/Create";
import Edit from "../../pages/portfolio/Edit";

export default [
    {
        path: '/admin/portfolio',
        component: Index,
        name: 'portfolio.index'
    },
    {
        path: '/admin/portfolio/create',
        component: Create,
        name: 'portfolio.create'
    },
    {
        path: '/admin/portfolio/:id/edit',
        component: Edit,
        name: 'portfolio.edit'
    },
]
