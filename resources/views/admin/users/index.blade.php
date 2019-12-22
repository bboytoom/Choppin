@extends('layouts.admin_layout')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Usuarios</h1>

    <div id="app">
        <user-component v-bind:data="users" 
                        v-on:create="createUser" 
                        v-on:edit="editUser" 
                        v-on:delete="deleteUser">
        </user-component>

        @include('admin.users.edit')
    </div>

@endsection
