<?php
// 从前端接收数据
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// 这里可以对接收到的数据进行处理
// 例如，生成一个唯一的 ID
$data['id'] = uniqid();

// 将数据写入 CSV 文件
$csvFile = 'example.csv';

// 检查文件是否存在，不存在则创建文件并写入表头
if (!file_exists($csvFile)) {
    $csvHeader = array('ID', 'Message');
    file_put_contents($csvFile, implode(',', $csvHeader) . PHP_EOL, FILE_APPEND | LOCK_EX);
}

// 将数据写入 CSV 文件
$csvData = array($data['id'], $data['message']);
file_put_contents($csvFile, implode(',', $csvData) . PHP_EOL, FILE_APPEND | LOCK_EX);

// 响应数据给前端
$response = array('status' => 'success', 'message' => '数据已成功接收并存储到 CSV 文件');
echo json_encode($response);
?>
