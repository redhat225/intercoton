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
    </title>
    <?= $this->Html->meta('favicon.png','/img/favicon.png',['type'=>'icon']) ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('../node_modules/bulma/custom-bulma') ?>
    <?= $this->Html->css('main') ?>
    <?= $this->Html->css('../node_modules/toastr/build/toastr.min') ?>
    <?= $this->fetch('css') ?>


    
    <?= $this->fetch('script') ?>
</head>
<body ng-app="login" ng-controller="MainCtrl as mainctrl" >

    <?= $this->fetch('content') ?>
    <!-- Load angular app here -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <?= $this->Html->script('../node_modules/angular/angular.min') ?>
    <?= $this->Html->script('../node_modules/toastr/build/toastr.min') ?>

    <?= $this->Html->script('auth/login') ?>
    <script>
       toastr.options = {
        progressBar: true,
        preventDuplicates: true,
        showMethod: 'slideDown',
        hideMethod: 'slideUp',
        closeMethod:'slideUp',
        newestOnTop: true,
        closeButton :true,
        // timeOut:0,
        // extendedTimeOut:0
       };
    </script>
</body>
</html>
