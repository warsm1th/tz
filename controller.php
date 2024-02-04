<?php
require_once 'model.php';

$model = new Model($_POST);

$model->getInfo();