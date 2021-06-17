<template>
    <div id="app">
        <v-toolbar app dark color="primary">
            <v-toolbar-side-icon @click="drawer = !drawer" class="hidden-md-and-up"></v-toolbar-side-icon>
            <v-toolbar-title>
                <router-link to="/" tag="span" class="pointer">Тестовое приложение</router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn to="/create"> cоздать </v-btn>
                <v-btn to="/articles"> все записи </v-btn>
                <v-btn @click="onLogout" flat v-if="isUserLoggedIn">
                    <v-icon left>exit_to_app</v-icon> Logout </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <router-view/> </div>
</template>
<style>
    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
    }
    
    .href {
        text-decoration: none;
    }
    
    #nav {
        padding: 30px;
    }
    
    #nav a {
        font-weight: bold;
        color: #2c3e50;
    }
    
    #nav a.router-link-exact-active {
        color: #42b983;
    }
</style>