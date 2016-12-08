<?php
/**
 * Hook to implement Slack Notification
 */

function HookSlack_connectAllaftersaveresourcedata()
{
    $curPage = basename($_SERVER['PHP_SELF']);
    $clickNext = 'edit.php';
    $uploadPerm = strtok($_SERVER['QUERY_STRING'], '&');

    if ($curPage === $clickNext && $uploadPerm === 'ref=-4'){

    $username = "ResourceSpace";
    $room = "asset-management";
    $icon = ":frame_with_picture:";
    $color = "good";
    $title = "New Assets Incoming for Review";
    $text = "New Assets Incoming for Review";
    $review = urlencode("URL OF REVIEW PAGE");

    $attachment = array(
        'fallback' => $text,
        'color' => $color,
        'title' => $title,
        'title_link' => $review
    );

    $data = "payload=" . json_encode(array(
            "username" => "$username",
            "channel" => "#{$room}",
            "icon_emoji" => $icon,
            "attachments" => array($attachment)
        ));
    $url = "YOUR SLACK WEBHOOK URL";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    echo var_dump($result);
    if ($result === false) {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    return $result;
}
}