<?php
// コードベースのファイルのオートロード

use Helpers\RandomGenerator;

spl_autoload_extensions(".php"); 
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';



// ページの読み込み時に、ページにはランダムに生成された RestaurantChain のモックが表示され、それに関連するすべての情報が表示されます。
// これには、その場所、その場所の従業員、および会社の詳細が含まれます。
// クエリ文字列からパラメータを取得
$min = $_GET['min'] ?? 5;
$max = $_GET['max'] ?? 20;

// パラメータが整数であることを確認
$min = (int)$min;
$max = (int)$max;

// ユーザーの生成
$users = RandomGenerator::users($min, $max);

//会社の生成
$companies=RandomGenerator::companies(1, 3);

// レストランチェーンの生成
$chains=[];

foreach($companies as $company){

    $chains[]=RandomGenerator::restaurantChains(3,5,$company);
};

// echo '<pre>';
// print_r($chains);
// echo '</pre>';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestaurantChain</title>
    <style>
        /* ユーザーカードのスタイル */
    </style>
</head>
<body>
    <h1>User Profiles</h1>
    <?php foreach ($chains as $chainGroup): ?>
        会社名
        <?php foreach ($chainGroup as $chain): ?>
            チェーン名　料理の種類　総店舗数
            　　各チェーン店の情報　住所　営業中か　ドライブスルー濃霧　従業員数
            　　　　各チェーン店の従業員情報　名前　職責　給与　賞のリスト
            <?= $chain->toHTML(); ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

</body>
</html>