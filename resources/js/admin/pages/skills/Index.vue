<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-data-table
                        :headers="headers"
                        :items="skills"
                        :search="search"
                        sort-by="calories"
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
                                <router-link :to="{ name: 'skills.create' }">
                                    <v-btn color="primary" dark class="mb-2">{{ $t('fields.newItem') }}</v-btn>
                                </router-link>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.action="{ item }">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <router-link
                                        :to="{ name: 'skills.edit', params: {id: item.id} }"
                                        style="text-decoration:none;"
                                    >
                                        <v-icon
                                            v-on="on"
                                            small
                                            class="mr-2"
                                        >
                                            mdi-pencil
                                        </v-icon>
                                    </router-link>
                                </template>
                                <span>{{ $t('crud.edit') }}</span>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-icon
                                        v-on="on"
                                        small
                                        @click="deleteSkill(item.id)"
                                    >
                                        delete
                                    </v-icon>
                                </template>
                                <span>{{ $t('crud.delete') }}</span>
                            </v-tooltip>
                        </template>
                        <template v-slot:no-data>
                            <v-btn color="primary" @click="getSkills">Reset</v-btn>
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
                    { text: this.$t('fields.title'), value: 'title' },
                    { text: this.$t('fields.percent'), value: 'percent' },
                    { text: this.$t('fields.created_at'), value: 'created_at' },
                    { text: this.$t('fields.actions'), value: 'action', sortable: false },
                ],
                desserts: [],
            }
        },
        mounted() {
            this.getSkills();
        },
        computed: {
            ...mapGetters({
                skills: 'skills/skills'
            }),
        },
        methods: {
            ...mapActions({
                getSkills: 'skills/getSkills',
                showSnackbar: 'snackbar/showSnackbar'
            }),

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.users[this.editedIndex], this.editedItem)
                } else {
                }
                this.close()
            },

            deleteSkill(id)
            {
                var res = confirm('Are you sure?');
                if(res)
                {
                    axios
                        .post('/api/skills/' + id + '/delete')
                        .then( res => {
                            this.showSnackbar('Removed');
                            this.getSkills();
                        })
                        .catch(res => {
                            console.log(res.response);
                            this.showSnackbar('Something went wrong.');
                        });
                }
            }
        },
    }
</script>

<style scoped>

</style>
