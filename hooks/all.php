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
    $room = "asset-management"; // Change to the room You want the message to appear in.
    $icon = ":frame_with_picture:";
    $color = "good";
    $title = "New Assets Incoming for Review";
    $text = "New Assets Incoming for Review";
    $review = urlencode("./resourcespace/pages/search.php?search=&archive=-1&resetrestypes=true"); // Change this to the url of the page you approve pending assets on

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
    $url = "https://hooks.slack.com/services/../../../"; // Change this to your Slack Webhook URL


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