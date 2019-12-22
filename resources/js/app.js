/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.Swal = require('sweetalert2')

import { ValidationProvider, ValidationObserver, extend, localize } from 'vee-validate';
import en from 'vee-validate/dist/locale/en.json';
import * as rules from 'vee-validate/dist/rules';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule]);
});

localize('en', en);

Vue.component('user-component', require('./components/Users.vue').default);
Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer', ValidationObserver);

Vue.config.productionTip = false;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
    data: function () {
        return {
            users: [],
            errorsusers: [],
            user: {
                'id':'', 
                'name':'',
                'mother_surname':'',
                'father_surname':'',
                'email':'',
                'status':''
            }
        }
    },
    created() {
        this.indexUser();
    },
    methods: {
        resetForm() {
            this.user.id = 0;
            this.user.name = '';
            this.user.mother_surname = '';
            this.user.father_surname = '';
            this.user.email = '';
            this.user.status = false
        },
        indexUser() {
            axios.get('/api/v1/users')
            .then((response) => {
                this.users = response.data.data;
            }).catch(error => {
                console.log(error);
            });
        },
        createUser() {
            this.errorsusers = [];

            this.resetForm();
            $("#userModal").modal('show');
        },
        editUser(id) {
            this.errorsusers = [];

            axios.get('/api/v1/users/'+id)
            .then((response) => {
                this.user.id = response.data.id;
                this.user.name = response.data.attributes.name;
                this.user.mother_surname = response.data.attributes.mother_surname;
                this.user.father_surname = response.data.attributes.father_surname;
                this.user.email = response.data.attributes.email;
                this.user.status = (response.data.attributes.status === 1)? true: false;

                $("#userModal").modal('show');
            }).catch(error => {
                console.log(error);
            });
        },
        deleteUser(id) {
            axios.delete('/api/v1/users/'+id)
            .then((response) => {
                if(response.status === 204) {
                    this.indexUser();
                    
                    const ToastDelete = Swal.mixin({
                        toast: true,
                        position: 'top-start',
                        showConfirmButton: false,
                        timer: 3000,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    ToastDelete.fire({
                        icon: 'success',
                        title: 'El usuario se elimino correctamente'
                    });
                } else {
                    console.log('error en la peqicion');
                }
            }).catch(error => {
                console.log(error);
            });
        },
        userForm (user) {
            var data = {
                'name': user.name,
                'mother_surname': user.mother_surname,
                'father_surname': user.father_surname,
                'email': user.email,
                'status': user.status
            };

            if(user.id == 0) {
                axios.post('/api/v1/users/', data)
                .then((response) => {
                    if(response.status === 201) {
                        $("#userModal").modal('hide');
                        this.resetForm();
                        this.indexUser();

                        const ToastCreate = Swal.mixin({
                            toast: true,
                            position: 'top-start',
                            showConfirmButton: false,
                            timer: 3000,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        ToastCreate.fire({
                            icon: 'success',
                            title: 'El usuario se agrego correctamente'
                        });
                    } else {
                        console.log('error en la peticion');
                    }
                }).catch(error => {
                    this.errorsusers = error.response.data.errors;
                });
            } else {
                axios.put('/api/v1/users/'+user.id, data)
                .then((response) => {
                    if(response.status === 200) {
                        $("#userModal").modal('hide');
                        this.resetForm();
                        this.indexUser();
                        
                        const ToastUpdate = Swal.mixin({
                            toast: true,
                            position: 'top-start',
                            showConfirmButton: false,
                            timer: 3000,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        ToastUpdate.fire({
                            icon: 'success',
                            title: 'El usuario se actualizo correctamente'
                        });
                    } else {
                        console.log('error en la peqicion');
                    }
                }).catch(error => {
                    this.errorsusers = error.response.data.errors;
                });
            }
        }
    }
});
