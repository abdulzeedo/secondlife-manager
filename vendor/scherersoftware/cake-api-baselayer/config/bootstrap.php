<?php
use Cake\Core\Configure;

if (substr(env('REQUEST_URI'), 0, 5) === '/api/') {
    Configure::write('Error.exceptionRenderer', '\CkTools\Error\ApiExceptionRenderer');
}
