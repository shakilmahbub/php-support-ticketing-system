<?php

class Route
{
    public static $routes = [
        [
            'route' => 'login',
            'method' => 'POST',
            'controller' => 'UserController',
            'function' => 'login',
            'protection_type' => 'public'
        ],
        [
            'route' => 'register',
            'method' => 'POST',
            'controller' => 'UserController',
            'function' => 'registration',
            'protection_type' => 'public'
        ],
        [
            'route' => 'logout',
            'method' => 'POST',
            'controller' => 'UserController',
            'function' => 'logout'
        ],
        [
            'route' => 'tickets',
            'method' => 'GET',
            'controller' => 'TicketsController',
            'function' => 'index'
        ],
        [
            'route' => 'tickets',
            'method' => 'POST',
            'controller' => 'TicketsController',
            'function' => 'store'
        ],
        [
            'route' => 'tickets/{id}',
            'method' => 'GET',
            'controller' => 'TicketsController',
            'function' => 'show'
        ],
        [
            'route' => 'tickets/{id}',
            'method' => 'DELETE',
            'controller' => 'TicketsController',
            'function' => 'destroy'
        ],
        [
            'route' => 'tickets/{id}',
            'method' => 'PUT',
            'controller' => 'TicketsController',
            'function' => 'update'
        ],
        [
            'route' => 'tickets/{id}/assign',
            'method' => 'PUT',
            'controller' => 'TicketsController',
            'function' => 'assignTicket'
        ],
        [
            'route' => 'tickets/{id}/status',
            'method' => 'PUT',
            'controller' => 'TicketsController',
            'function' => 'changeStatus'
        ],
        [
            'route' => 'departments',
            'method' => 'GET',
            'controller' => 'DepartmentsController',
            'function' => 'index'
        ],
        [
            'route' => 'departments',
            'method' => 'POST',
            'controller' => 'DepartmentsController',
            'function' => 'store'
        ],
        [
            'route' => 'departments/{id}',
            'method' => 'GET',
            'controller' => 'DepartmentsController',
            'function' => 'show'
        ],
        [
            'route' => 'departments/{id}',
            'method' => 'DELETE',
            'controller' => 'DepartmentsController',
            'function' => 'destroy'
        ],
        [
            'route' => 'departments/{id}',
            'method' => 'PUT',
            'controller' => 'DepartmentsController',
            'function' => 'update'
        ],
        [
            'route' => 'notes',
            'method' => 'GET',
            'controller' => 'NotesController',
            'function' => 'index'
        ],
        [
            'route' => 'notes',
            'method' => 'POST',
            'controller' => 'NotesController',
            'function' => 'store'
        ],
        [
            'route' => 'notes/{id}',
            'method' => 'GET',
            'controller' => 'NotesController',
            'function' => 'show'
        ],
        [
            'route' => 'notes/{id}',
            'method' => 'DELETE',
            'controller' => 'NotesController',
            'function' => 'destroy'
        ],
        [
            'route' => 'notes/{id}',
            'method' => 'PUT',
            'controller' => 'NotesController',
            'function' => 'update'
        ],
        [
            'route' => 'users',
            'method' => 'GET',
            'controller' => 'UserController',
            'function' => 'getuser'
        ],
        [
            'route' => 'users',
            'method' => 'POST',
            'controller' => 'UserController',
            'function' => 'store'
        ],
        [
            'route' => 'users/{id}',
            'method' => 'GET',
            'controller' => 'UserController',
            'function' => 'show'
        ],
        [
            'route' => 'users/{id}',
            'method' => 'DELETE',
            'controller' => 'UserController',
            'function' => 'destroy'
        ],
        [
            'route' => 'users/{id}',
            'method' => 'PUT',
            'controller' => 'UserController',
            'function' => 'update'
        ]
    ];


}