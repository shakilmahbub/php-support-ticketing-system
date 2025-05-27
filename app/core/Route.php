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
            'function' => 'assignticket'
        ],
        [
            'route' => 'tickets/{id}/status',
            'method' => 'PUT',
            'controller' => 'TicketsController',
            'function' => 'changestatus'
        ]

    ];


}