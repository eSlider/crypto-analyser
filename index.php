<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'vendor/autoload.php';
include 'config.php';

$nodes = new \Eslider\NodeManager($nodeInfos);

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>

    <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <title>Blockchain info</title>
</head>
<body>

<h1>Status</h1>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Status</th>
        <th scope="col">Started</th>
        <th scope="col">Attempt</th>
        <th scope="col">BlockchainSynced</th>
        <th scope="col">MasternodeListSynced</th>
        <th scope="col">WinnersListSynced</th>
        <th scope="col">Synced</th>
        <th scope="col">Failed</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($nodes as $node) {
        $status = $node->getStatus();
        ?>
        <tr>
            <td><?= $node->getName()?></td>
            <td><?= $status['AssetName'] ?></td>
            <td><?= date('Y-m-d H:i:s', $status['AssetStartTime']) ?></td>
            <td><?= $status['Attempt'] ?></td>
            <td><?= $status['IsBlockchainSynced'] ? 'yes' : 'no' ?></td>
            <td><?= $status['IsMasternodeListSynced'] ? 'yes' : 'no' ?></td>
            <td><?= $status['IsWinnersListSynced'] ? 'yes' : 'no' ?></td>
            <td><?= $status['IsSynced'] ? 'yes' : 'no' ?></td>
            <td><?= $status['IsFailed'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
</html>
