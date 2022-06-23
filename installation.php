VUE GLOBALY INSTALL
=============================
npm install -g @vue/cli

CREATE VIEW PROJECT
===============================
vue create projectname

RUN COMMAND
======================================
npm run serve

FOR POST, DELETE,GET Etc. API (install axios)
=======================================
npm install axios

Adding AXIOS code inside vue component
<template>
<h3>Signup</h3>
<div class="register">
    <input type="text" v-model="name" placeholder="Name">
    <input type="text" v-model="email" placeholder="Email">
    <input type="text" v-model="password" name="password" placeholder="Password">
    <button v-on:click="signup" type="button">Submit</button>
</div>
</template>
<script>
import axios from 'axios'
export default{
    name:'SignUp',
    data()
    {
      return {
        name:'',
        email:'',
        password:''
      }
    },
    methods:{
       async signup(){
            console.warn('signup',this.name,this.email,this.password)
            let result = await axios.post('http://localhost:3000/users',{
                id:4,
                name:this.name,
                email:this.email,
                password:this.password
            });
            console.warn(result)
            localStorage.setItem('user-info',JSON.stringify(result.data))
            
        }
    }
}
</script>


INSTLL ROUTE
===================================
npm install vue-router@next

CREATING FILE routes.js (inside src folder)
========================================
import HomePage from './components/HomePage.vue'
import SignUp from './components/SignUp.vue'

import {createRouter,createWebHistory} from 'vue-router'

const routes = [
    {
        name:'HomePage',
        component:HomePage,
        path:'/'
    },
    {
        name:'Signup',
        component:SignUp,
        path:'/sign-up'
    },
]
const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router

ADDING ROUTER IN main.js file
=================================
import { createApp } from 'vue'
import App from './App.vue'
import router from './routes'
createApp(App).use(router).mount('#app');

ADDING ROUTER LINK IN app.vue FILE
=====================================
<template>  
  <router-view></router-view>
</template>

<script>

export default {
  name: 'App',
  }
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>

FOR DYNAMIC TITLE
==================================
1. create a .env file inside your root directory.env -> VUE_APP_TITLE = Saroj First View App2. open index.html inside public folderAdding in title section : process.env.VUE_APP_TITLE 3. open router.js file after const router = createRouter({})  adding this code
router.beforeEach((to, from, next) => {
    //console.log('beforeeach');
    document.title = `${process.env.VUE_APP_TITLE} - ${to.name}` 
    next()
  })


SIGNUP VUE PAGE
=============================
<template>
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                 <h1>Sign Up</h1>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" v-model="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" v-model="password" class="form-control">
                </div>
                <div class="form-group">
                    <button type="button" v-on:click="signup" class="btn btn-primary">Signup</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default{
        name:'SignUp',
        data(){
            return{
                name:'',
                email:'',
                password:''
            }
        },
        methods:{
            async signup(){
                console.log(this.name,this.email,this.password)

                let result = await axios.post('http://localhost:3000/users',{
                    id:8,
                    name:this.name,
                    email:this.email,
                    password:this.password
                })
                if(result.status == 201){
                console.warn(result);
                localStorage.setItem('user-info',JSON.stringify(result.data))
                }
            }
        },
        mounted(){
           let userinfo = localStorage.getItem('user-info');
           console.warn(userinfo)
           if(userinfo){
                this.$router.push({name:'HomePage'});
           }
        }
    }
</script>

HOME PAGE MOUNT CONDITION===================================mounted(){
           let userinfo = localStorage.getItem('user-info');
           console.warn(userinfo)
           if(!userinfo){
                this.$router.push({name:'SignUp'});
           }
        }
