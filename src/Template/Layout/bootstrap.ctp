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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css([
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css'
    ]); ?>
    <?= $this->Html->script([
    'https://code.jquery.com/jquery-1.12.4.min.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js'
    ]); ?>
    <?= $this->Html->script('jquery-barcodeListener.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        .button-has-error {
            border: 1px solid red;
        }
        .button-has-success {
            border: 1px solid green;
        }
        .navbar-text, .navbar-link{
            color: white!important;
        }
    </style>
</head>
<body>
    <?php
        echo $this->Navbar->create('Phone', ['responsive' => 'true', 'fluid' => 'true', 'inverse' => true]);
        echo $this->Navbar->beginMenu();
        echo $this->Navbar->link('List Phones', ['action' => 'index']);
        echo $this->Navbar->beginMenu('List others');
        echo $this->Navbar->link('List Storages', ['controller' => 'Storages', 'action' => 'index']);
        echo $this->Navbar->link('List Models', ['controller' => 'Models', 'action' => 'index']);
        echo $this->Navbar->link('List Colours', ['controller' => 'Colours', 'action' => 'index']);
        echo $this->Navbar->link('List Repairs', ['controller' => 'Repairs', 'action' => 'index']);
        echo $this->Navbar->link('List Returns', ['controller' => 'ItemReturns', 'action' => 'index']);
        echo $this->Navbar->link('List Suppliers', ['controller' => 'Suppliers', 'action' => 'index']);
        echo $this->Navbar->link('List Supplier Orders', ['controller' => 'SupplierOrders', 'action' => 'index']);
        echo $this->Navbar->link('List Users', ['controller' => 'Users', 'action' => 'index']);
        echo $this->Navbar->endMenu();
        echo $this->Navbar->beginMenu('Create');
        echo $this->Navbar->link('New Storage', ['controller' => 'Storages', 'action' => 'add']);
        echo $this->Navbar->link('New Model', ['controller' => 'Models', 'action' => 'add']);
        echo $this->Navbar->link('New Colour', ['controller' => 'Colours', 'action' => 'add']);
        echo $this->Navbar->link('New Repairs', ['controller' => 'Repairs', 'action' => 'add']);
        echo $this->Navbar->link('New Returns', ['controller' => 'ItemReturns', 'action' => 'add']);
        echo $this->Navbar->link('New Suppliers', ['controller' => 'Suppliers', 'action' => 'add']);
        echo $this->Navbar->link('New Supplier Orders', ['controller' => 'SupplierOrders', 'action' => 'add']);
        echo $this->Navbar->endMenu();
        echo $this->Navbar->link('Connected Phones', ['controller' => 'Phones', 'action' => 'connection']);
        echo $this->Navbar->link('Download Diagnosis', ['controller' => 'Phones', 'action' => 'download']);
        echo $this->Navbar->endMenu();

        //echo $this->Navbar->searchForm();

        echo '<div class="navbar-right">';

        if ($user)
            echo $this->Navbar->text(
                'Signed in as '
                .$user['email']
                .', '.
                $this->Html->link('Log out',
                                  ['controller' => 'users', 'action' => 'logout', 'redirect' => $this->request->here],
                                  ['class' => 'btn btn-danger btn-xs']
                )
            );
        else
            echo $this->Navbar->text(
                $this->Html->link('Log in', ['controller' => 'users', 'action' => 'login', 'redirect' => $this->request->here], ['class' => 'btn btn-primary btn-xs'])
                . ' or '.
        $this->Html->link('Register', ['controller' => 'users', 'action' => 'add', 'redirect' => $this->request->here], ['class' => 'btn btn-primary btn-xs'])
            );
        echo '</div>';
        echo $this->Navbar->end();
    ?>


    <?= $this->Flash->render() ?>

    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
