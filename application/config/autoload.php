<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('session', 'database', 'mapping');

$autoload['drivers'] = array();

$autoload['helper'] = array(
                          'url',
                          'date',
                          'file',
                          'form',
                          'string',
                          'cookie',
                        );

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('sync');
