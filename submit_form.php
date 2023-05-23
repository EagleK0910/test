<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 獲取表單提交的數據
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // 使用 Discord Webhook 發送消息
    $webhookUrl = 'https://discord.com/api/webhooks/1110444008431431681/8HZFTY3COWsOv1OaEiVSpAU-dhZrX1WjUwEdk3g666P1UOPeK5fj_1Rn5GLRvVreZG6l';
    $content = "姓名：$name\n電子郵件：$email\n訊息：$message";
    
    // 將數據組成 JSON 格式
    $payload = json_encode(array('content' => $content));
    
    // 發送 POST 請求到 Discord Webhook
    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo '表單提交成功，但發送 Discord 消息失敗';
    } else {
        echo '表單提交成功，已發送 Discord 消息';
    }
} else {
    echo '無效的請求';
}
?>
