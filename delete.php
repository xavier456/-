<?php
// 假设这是后端处理删除请求的 PHP 文件

// 接收前端发送的 JSON 数据
$data = json_decode(file_get_contents("php://input"), true);

// 获取要删除的数据的 ID
$deleteId = $data['id'];

// 读取原始 CSV 数据
$csvFile = 'example.csv';
$csvData = file_get_contents($csvFile);

// 将 CSV 数据转换成数组
$csvArray = array_map('str_getcsv', explode("\n", $csvData));

// 查找要删除的行，并从数组中移除
foreach ($csvArray as $key => $row) {
    if ($row[0] == $deleteId) {
        unset($csvArray[$key]);
        break;
    }
}

// 重新生成 CSV 数据
$newCsvData = implode("\n", array_map('implode', $csvArray));

// 将新的 CSV 数据写回文件
file_put_contents($csvFile, $newCsvData);

// 返回成功的响应
echo json_encode(['status' => 'success']);
?>
