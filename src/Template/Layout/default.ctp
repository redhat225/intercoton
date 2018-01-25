<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$pageDescription = 'Intercoton: Organisation interprofessionnelle agricole de la filière coton';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $pageDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('favicon.png','/img/favicon.png',['type'=>'icon']) ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('../node_modules/bulma/custom-bulma') ?>
    <?= $this->Html->css('main') ?>
    <!-- Another Css -->
    <?= $this->Html->css('../node_modules/toastr/build/toastr.min') ?>
    <?= $this->Html->css('../node_modules/hover.css/css/hover-min.css') ?>
    <?= $this->Html->css('loading-bar-custom') ?>

    <?= $this->fetch('css') ?>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <?= $this->Html->script('../bower_components/tinymce/tinymce') ?>
    
    <?= $this->Html->script('../node_modules/angular/angular.min') ?>
    <?= $this->Html->script('../node_modules/@uirouter/angularjs/release/angular-ui-router.min') ?>
    <!-- Another Scripts -->
    <?= $this->Html->script('../node_modules/toastr/build/toastr.min') ?>
    <?= $this->Html->script('../node_modules/ng-file-upload/dist/ng-file-upload-all.min') ?>
    <?= $this->Html->script('../node_modules/angular-loading-bar/src/loading-bar') ?>
    <?= $this->Html->script('../bower_components/angular-ui-tinymce/src/tinymce') ?>
    <base href="/admins/">
</head>
<body ng-app="intercoton">
    <section ui-view></section>

    <!-- Angular app goes here -->
    <?= $this->Html->script('Admin/app') ?>
    <?= $this->Html->script('Admin/controllers') ?>
    <?= $this->Html->script('Admin/services') ?>
    <?= $this->Html->script('Admin/directives') ?>
    <?= $this->fetch('script') ?>

</body>
</html>
