<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/res/php/init.php');

    if (checkRequestMethod($_SERVER['REQUEST_METHOD'], 'GET')) {
        $querySelectDomains = "
            SELECT * FROM `DomainList`
            ORDER BY `Id`
        ";
        $checkSelectDomains = $pdo->prepare($querySelectDomains);
        $return['domain'] = [];
        if ($checkSelectDomains->execute()) {
            $return['domain'] = $checkSelectDomains->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($return['domain'])) {
            $return['domain'] = null;
        }

        $querySelectChannels = "
            SELECT * FROM `ChannelList`
            ORDER BY `Id`
        ";
        $checkSelectChannels = $pdo->prepare($querySelectChannels);
        $return['channel'] = [];
        if ($checkSelectChannels->execute()) {
            $return['channel'] = $checkSelectChannels->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($return['channel'])) {
            $return['channel'] = null;
        }

        $querySelectAccess = "
            SELECT * FROM `AllowedList2`
            ORDER BY `Id`
        ";
        $checkSelectAccess = $pdo->prepare($querySelectAccess);
        $return['access'] = [];
        if ($checkSelectAccess->execute()) {
            $return['access'] = $checkSelectAccess->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($return['access'])) {
            $return['access'] = null;
        }

    }

    die(json_encode($return));