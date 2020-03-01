import Index from "../../pages/skills/Index";
import Edit from "../../pages/skills/Edit";
import Create from "../../pages/skills/Create";

export default [
    {
        path: '/admin/skills',
        component: Index,
        name: 'skills.index'
    },
    {
        path: '/admin/skills/:id/edit',
        component: Edit,
        name: 'skills.edit'
    },
    {
        path: '/admin/skills/create',
        component: Create,
        name: 'skills.create'
    },
]
