<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-data-table
                        :headers="headers"
                        :items="all"
                        :search="search"
                        class="elevation-1"
                        :items-per-page="5"
                    >
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-text-field
                                    v-model="search"
                                    :label="$t('fields.search')"
                                    single-line
                                    hide-details
                                ></v-text-field>
                                <v-spacer></v-spacer>
                                <router-link :to="{ name: 'portfolio.create' }">
                                    <v-btn color="primary" dark class="mb-2">{{ $t('fields.newItem') }}</v-btn>
                                </router-link>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.action="{ item }">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <router-link
                                        :to="{ name: 'portfolio.edit', params: {id: item.id} }"
                                        style="text-decoration:none;"
                                    >
                                        <v-icon
                                            v-on="on"
                                            small
                                            class="mr-2"
                                        >
                                            edit
                                        </v-icon>
                                    </router-link>
                                </template>
                                <span>{{ $t('crud.edit') }}</span>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-icon
                                        @click="deleteProject(item.id)"
                                        small
                                        v-on="on"
                                    >
                                        delete
                                    </v-icon>
                                </template>
                                <span>{{ $t('crud.delete') }}</span>
                            </v-tooltip>
                        </template>
                        <template v-slot:no-data>
                            <v-btn color="primary" @click="getAll" :loading="loading">Reset</v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "Index",
        data () {
            return {
                search: '',
                headers: [
                    {
                        text: 'ID',
                        align: 'left',
                        sortable: false,
                        value: 'id',
                    },
                    { text: 'Title', value: 'title' },
                    { text: 'Url', value: 'url' },
                    { text: 'Category', value: 'category.title' },
                    { text: 'Created At', value: 'created_at' },
                    { text: 'Actions', value: 'action', sortable: false },
                ],
                desserts: [],
                loading: false,
            }
        },
        mounted() {
            this.getAll();
        },
        computed: {
            ...mapGetters({
                all: 'portfolio/all'
            }),
        },
        methods: {
            ...mapActions({
                getAll: 'portfolio/getAll',
                showSnackbar: 'snackbar/showSnackbar'
            }),
            deleteProject(id){
                var res = confirm('Are you sure?');
                if(res)
                {
                    axios
                        .post('/api/portfolio/'+id+'/delete')
                        .then(res => {
                            this.showSnackbar('Removed');
                            this.getAll()
                        })
                        .catch(res => {
                            console.log(res.response);
                            this.showSnackbar('Something went wrong.');
                        })
                }
            }
        },
    }
</script>

<style scoped>

</style>
