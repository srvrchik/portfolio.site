import Index from "../../pages/users/Index";
import Create from "../../pages/users/Create";
import Edit from "../../pages/users/Edit";
import Password from "../../pages/users/Password";

export default [
    {
        path: '/admin/users',
        component: Index,
        name: 'users.index'
    },
    {
        path: '/admin/users/create',
        component: Create,
        name: 'users.create'
    },
    {
        path: '/admin/users/:id/edit',
        component: Edit,
        name: 'users.edit',
        props: true
    },
    {
        path: '/admin/users/:id/change/password',
        component: Password,
        name: 'users.edit.password',
        props: true
    },
]
