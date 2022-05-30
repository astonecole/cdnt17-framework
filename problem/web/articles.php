<?php

require 'init.php';

include 'template/header.phtml'; ?>
?>
    <main class="container mt-4">
        <h1 class="mb-5">Blogger</h1>

        <div class="row">
            <div class="col-md-8">
                <?php
                $categoryID = isset($_GET['category']) ? (int) $_GET['category'] : null;
                $sql = 'SELECT a.article_id, a.title, a.teaser, a.status, c.category_id, c.name
                        FROM article AS a
                        LEFT JOIN article_has_category AS ac
                            ON a.article_id = ac.article_id
                        LEFT JOIN category AS c
                            ON ac.category_id = c.category_id
                        WHERE a.status = 1';

                if ($categoryID) {
                    $sql .= ' AND c.category_id=' . $categoryID . ' ';
                }

                $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

                include 'lib/array.php';
                $config = [
                    'groupBy' => 'article_id',
                    'alias' => 'categories',
                    'columns' => ['category_id', 'name'],
                ];

                $result = array_aggregate($data, $config);
                ?>

                <?php foreach ($result as $row) : ?>
                    <article class="mb-5">
                        <h2><?= $row['title']; ?></h2>
                        <p class="text-secondary"><?= $row['teaser']; ?></p>
                        <div>
                            <?php foreach ($row['categories'] as $cat) : ?>
                                <a href="?category=<?= $cat['category_id'] ?>" class="btn btn-sm bg-warning text-dark">
                                    <span><?= $cat['name']; ?></span>
                                </a>
                            <?php endforeach; ?>
                            <a class="btn btn-sm bg-success text-light" href="article.php?id=<?= $row['article_id'] ?>">
                                Lire l'article
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php
            $sql = 'SELECT a.status, c.category_id, c.name
                    FROM category AS c
                    JOIN article_has_category AS ac
                        ON c.category_id = ac.category_id
                    JOIN article AS a
                        ON ac.article_id = a.article_id
                    WHERE a.status = 1';
            ?>
            <div class="col-md-4">
                <h3>Categories</h3>
                <div>
                    <?php foreach ($pdo->query($sql) as $row) : ?>
                        <a href="?category=<?= $row['category_id'] ?>"><span class="badge bg-dark text-warning"><?= $row['name']; ?></span></a>
                    <?php endforeach; ?>
                    <a href="articles.php">
                        <span class="badge bg-dark text-warning">Toutes</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

<?php include 'template/footer.phtml'; ?>
