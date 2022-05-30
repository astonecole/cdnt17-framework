<?php

// Copyright 2022 Nanoninja. All rights reserved.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

try {
    $pdo = new PDO('mysql:host=dbtest;charset=utf8;dbname=blogger', 'root', 'root');
} catch (PDOException $e) {
    echo "Une erreur c'est produite";
    http_response_code(500);
    exit(1);
}
