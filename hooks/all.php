<?php
/**
 * Hook to implement Slack Notification
 */

function HookSlack_connectAllaftersaveresourcedata()
{
    if (getval("editthis_status","")=="true" && getval("status","")==-1){

    global $slack_connect_webhook;
    global $slack_connect_username;
    global $slack_connect_room;
    global $slack_connect_icon;
    global $slack_connect_color;
    global $slack_connect_title;
    global $slack_connect_link;
    global $slack_connect_fallback;

    $username = $slack_connect_username;
    $room = $slack_connect_room;
    $icon = ":" . $slack_connect_icon . ":";
    $color = $slack_connect_color;
    $title = $slack_connect_title;
    $text = $slack_connect_fallback;
    $review = urlencode($slack_connect_link);

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
    $url = $slack_connect_webhook;


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