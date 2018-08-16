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
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta(
        'favicon.ico',
        '/favicon.ico',
        ['type' => 'icon']
        );
    ?>

    <?= $this->Html->css([
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
    'https://cdn.datatables.net/v/bs/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/r-2.2.2/rg-1.0.3/datatables.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css',
    'https://use.fontawesome.com/releases/v5.2.0/css/all.css',
    '/css/bootstrap-datetimepicker.css',
    '/css/custom.css'
    ]); ?>
    <?= $this->Html->script([

    'https://code.jquery.com/jquery-1.12.4.min.js',
    'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.5/dist/loadingoverlay.min.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js',
    'https://cdn.datatables.net/v/bs/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/r-2.2.2/rg-1.0.3/datatables.min.js',
    '/js/moment.min.js',
    '/js/palette.js',
    '/js/bootstrap-datetimepicker.min.js',
    '/js/bootstrap.js',
    '/js/utility-functions.js'

    ]); ?>
    <?= $this->Html->script('jquery-barcodeListener.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
        if it's not present, don't show loader */
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/img/Preloader_1.gif') center no-repeat #fff;
        }
        /* ************************************** */
        /* ********** Loader css end ******** */
        /* ************************************** */
        span.fas {
            margin: 5px;
        }
        span.status-icon-badge {
            color: white;
            position: relative;
            text-align: center;
            top: 3px;
            font-size: 0.9rem;
            font-weight: 500;
            left: -3px;
            background: #8a8a8a;
            border-radius: 28px;
            padding: 1px 5px;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }
        .red-status-icon {
            color: red;
        }
        .yellow-status-icon {
            color: #ff9b16;
        }
        .green-status-icon {
            color: #14d62f;
        }
        .unknown-status-icon {
            color: lightgrey;
        }
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
    <script>$(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });</script>
</head>
<body>
    <div class="se-pre-con"></div>
    <?php
        echo $this->Navbar->create('Phone', ['responsive' => 'true', 'fluid' => 'true', 'inverse' => true]);
        echo $this->Navbar->beginMenu();
            echo $this->Navbar->link('List Phones', ['controller' => 'phones', 'action' => 'index']);
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
            echo $this->Navbar->beginMenu('Connected Phones');
                echo $this->Navbar->link('My phones', ['controller' => 'Phones', 'action' => 'connection', $userLoggedIn['id']]);
                echo $this->Navbar->link('All phones', ['controller' => 'Phones', 'action' => 'connection']);
            echo $this->Navbar->endMenu();
            echo $this->Navbar->link('All reports', ['controller' => 'Reports', 'action' => 'index']);

            echo $this->Navbar->link('Download Diagnosis', ['controller' => 'Phones', 'action' => 'download']);
        echo $this->Navbar->endMenu();

        //echo $this->Navbar->searchForm();

        echo '<div class="navbar-right">';

        if ($userLoggedIn)
            echo $this->Navbar->text(
                'Signed in as '
                .$userLoggedIn['email']
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
    <div style='position: fixed; margin-right: 2rem; right: 0;z-index: 999999;'>
        <div id="alert-box"></div>
    </div>



    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <?= $this->Html->script('/js/eventListeners.js') ?>

</body>
</html>
