import Index from "../../pages/categories/Index";
import Edit from "../../pages/categories/Edit";
import Create from "../../pages/categories/Create";

export default [
    {
        path: '/admin/categories',
        component: Index,
        name: 'categories.index'
    },
    {
        path: '/admin/categories/:id/edit',
        component: Edit,
        name: 'categories.edit'
    },
    {
        path: '/admin/categories/create',
        component: Create,
        name: 'categories.create'
    },
]
