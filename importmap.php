<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    'manga_controller' => [
        'path' => './assets/controllers/manga_controller.js',
        'entrypoint' => true,
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.4',
    ],
    'bootstrap' => [
        'version' => '5.3.3',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.3',
        'type' => 'css',
    ],
    '@fortawesome/fontawesome-free' => [
        'version' => '6.5.2',
    ],
    '@fortawesome/fontawesome-free/css/fontawesome.min.css' => [
        'version' => '6.5.2',
        'type' => 'css',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'datatables.net-bs5' => [
        'version' => '2.0.3',
    ],
    'datatables.net' => [
        'version' => '2.0.3',
    ],
    'datatables.net-bs5/css/dataTables.bootstrap5.min.css' => [
        'version' => '2.0.3',
        'type' => 'css',
    ],
    '@fortawesome/fontawesome-free/css/all.min.css' => [
        'version' => '6.5.2',
        'type' => 'css',
    ],
    'datatables.net-plugins/i18n/fr-FR.mjs' => [
        'version' => '2.0.7',
    ],
];
