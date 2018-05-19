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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

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
    <?php foreach ($nodes->getStatus() as $status) { ?>

        <tr>
            <td><?= $status['name'] ?></td>
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
