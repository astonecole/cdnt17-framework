<?php

function getArticles(PDO $pdo, $categoryID = null)
{
    $sql = 'SELECT a.article_id, a.title, a.teaser, a.status, c.category_id, c.name
    FROM article AS a
    LEFT JOIN article_has_category AS ac
        ON a.article_id = ac.article_id
    LEFT JOIN category AS c
        ON ac.category_id = c.category_id
    WHERE a.status = 1';

    if ($categoryID !== null) {
        $sql .= ' AND c.category_id=' . (int) $categoryID . ' ';
    }

    $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $config = [
        'groupBy' => 'article_id',
        'alias' => 'categories',
        'columns' => ['category_id', 'name'],
    ];

    return array_aggregate($data, $config);
}
