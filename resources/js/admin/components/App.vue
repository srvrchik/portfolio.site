<template>
    <v-app id="inspire" >
        <v-app-bar
            app
            clipped-right
            color="blue-grey"
            dark
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title>{{ $t('header.panel') }}</v-toolbar-title>
            <v-spacer />
            <v-menu
                left
                bottom
            >
                <template v-slot:activator="{ on }">
                    <v-btn icon v-on="on">
                        <v-icon>mdi-flag</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item @click="changeLang('ru')">
                        <v-list-item-title>Ru</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="changeLang('en')">
                        <v-list-item-title>En</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-progress-linear
                :active="loading"
                :indeterminate="loading"
                bottom
                absolute
            ></v-progress-linear>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-list dense>
<!--                <v-list-item @click.stop="left = !left">-->
<!--                    <v-list-item-action>-->
<!--                        <v-icon>mdi-exit-to-app</v-icon>-->
<!--                    </v-list-item-action>-->
<!--                    <v-list-item-content>-->
<!--                        <v-list-item-title>Open Temporary Drawer</v-list-item-title>-->
<!--                    </v-list-item-content>-->
<!--                </v-list-item>-->
                <v-list-item v-for="(item, index) in leftItems" :key="'test' + index" :to="{ name: item.link }">
                    <v-list-item-action>
                        <v-icon>mdi-{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ $t('sidebar.' + item.title) }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

<!--        <v-navigation-drawer-->
<!--            v-model="left"-->
<!--            fixed-->
<!--            temporary-->
<!--        />-->

        <v-content>
            <transition
                name="fade"
                mode="out-in"
            >
                <router-view :key="componentKey"></router-view>
            </transition>
        </v-content>

<!--        <v-navigation-drawer-->
<!--            v-model="right"-->
<!--            fixed-->
<!--            right-->
<!--            temporary-->
<!--        />-->

        <v-footer
            app
            color="blue-grey"
            class="white--text"
        >
            <span>Vuetify</span>
            <v-spacer />
            <span>&copy; 2019</span>
        </v-footer>
        <snackbar></snackbar>
    </v-app>
</template>

<script>
    import Snackbar from "./Snackbar";
    import { mapActions, mapGetters } from 'vuex';

    export default {
        name: 'App',
        components: {
            snackbar: Snackbar
        },
        mounted() {
            this.getUser();
            this.setTheme();
        },
        data: () => ({
            componentKey: 0,
            loading: false,
            drawer: null,
            right: false,
            left: false,
            routerTransition: 'slide-left',
            leftItems: [
                {
                    title: 'dashboard',
                    icon: 'view-dashboard',
                    link: 'dashboard'
                },
                {
                    title: 'users',
                    icon: 'account',
                    link: 'users.index'
                },
                {
                    title: 'categories',
                    icon: 'settings',
                    link: 'categories.index'
                },
                {
                    title: 'portfolio',
                    icon: 'view-list',
                    link: 'portfolio.index'
                },
                {
                    title: 'skills',
                    icon: 'format-list-bulleted',
                    link: 'skills.index'
                },
                {
                    title: 'layoutSettings',
                    icon: 'settings',
                    link: 'settings.layout'
                },
            ]
        }),
        computed: {
            ...mapGetters({
                user: 'user/authUser'
            })
        },
        methods: {
            ...mapActions({
                getUser: 'user/getUser'
            }),
            changeLang(lang){
                this.$i18n.locale = lang;
                this.componentKey += 1;
            },
            setTheme(){
                setTimeout( () =>  {
                    this.$vuetify.theme.dark = !!this.user.admin_theme;
                }, 200)
            }
        },
    }
</script>

<style>
    .fade-enter-active,
    .fade-leave-active {
        transition-duration: 0.3s;
        transition-property: opacity;
        transition-timing-function: ease;
    }

    .fade-enter,
    .fade-leave-active {
        opacity: 0
    }
</style>
