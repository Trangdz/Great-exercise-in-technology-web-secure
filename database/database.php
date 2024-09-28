<!-- <?php
// if (defined('_INCODE')) die('Access deined');
?>
<div>
    <p> ?php>echo $exception->getMessage(); ?></p>
    <p> ?php echo $exception->getFile(); ?>
    <p> ?php echo $exception->getLine(); ?>
</div> -->

<?php
// Kiểm tra hằng số bảo mật _INCODE
if (!defined('_INCODE')) die('Access Denied...');

function query($sql, $data = [])
{
    global $conn;
    $query = false;
    try {
        $statement = $conn->prepare(($sql));
        if (empty($data)) {
            $query = $statement->execute();
        } else {
            $query = $statement->execute($data);
        }
    } catch (Exception $exception) {

        require_once 'D:\xampp\htdocs\baitaplon\modules\error\database.php';
        die(); // Dừng thực thi nếu có lỗi
    }
    if ($query) {
        return $statement;
    }
    return  $query;
}
function insert($table, $dataInsert)
{
    $keyArr = array_keys($dataInsert);
    $fieldStr = implode(', ', $keyArr);
    $valueStr = ':' . implode(', :', $keyArr);

    $sql = 'INSERT INTO ' . $table . ' (' . $fieldStr . ') VALUES (' . $valueStr . ')';

    return query($sql, $dataInsert);
}

// function update($table, $dataUpdate, $condition = '')
// {
//     $updateStr = '';
//     foreach ($dataUpdate as $key => $value) {
//         $updateStr .= $key . '=:' . $key . ', ';
//     }

//     $updateStr = rtrim($updateStr, ', ');

//     if (!empty($condition)) {
//         $sql = 'UPDATE ' . $table . ' SET ' . $updateStr . ' WHERE ' . $condition;
//     } else {
//         $sql = 'UPDATE ' . $table . ' SET ' . $updateStr;
//     }

//     return query($sql, $dataUpdate);
// }
function update($table, $dataUpdate, $condition = '')
{
    $updateStr = '';
    $params = [];

    foreach ($dataUpdate as $key => $value) {
        $updateStr .= $key . '=:' . $key . ', ';
        $params[':' . $key] = $value;
    }

    $updateStr = rtrim($updateStr, ', ');

    if (!empty($condition)) {
        $sql = 'UPDATE ' . $table . ' SET ' . $updateStr . ' WHERE ' . $condition;
    } else {
        $sql = 'UPDATE ' . $table . ' SET ' . $updateStr;
    }

    return query($sql, $params);
}

function delete($table, $condition = '')
{
    if (!empty($condition)) {
        $sql = "DELETE FROM $table WHERE $condition";
    } else {
        $sql = "DELETE FROM $table";
    }

    return query($sql);
}

// Lấy dữ liệu từ câu lệnh SQL
function getRaw($sql)
{
    $statement = query($sql, [], true);
    if (is_object($statement)) {
        $dataFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dataFetch;
    }

    return false;
}
// Lấy dữ liệu từ câu lệnh SQL - Lấy 1 bản ghi
function firstRaw($sql)
{
    $statement = query($sql, []);
    if (is_object($statement)) {
        $dataFetch = $statement->fetch(PDO::FETCH_ASSOC);
        return $dataFetch;
    };
    return false;
}
// function firstRaw($sql) {
//     // Execute the query using the query function
//     // Chuẩn bị câu lệnh truy vấn
//     global $conn;
//     $stmt = $conn->prepare($sql);

//     // Gán giá trị cho tham số :id
//     // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//     // $id = 14;

//     // Thực thi câu lệnh truy vấn
//     $stmt->execute();

//     // Lấy kết quả
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     // Kiểm tra và hiển thị kết quả
//     if ($result) {
//         // echo "ID: " . $result['id'] . "<br>";
//         // echo "Name: " . $result['fullname'] . "<br>";
//         // echo "Email: " . $result['email'] . "<br>";

//         return $result;
//     } else {
//         return false;
//     }
// }

function get($table, $field = '*', $condition = '')
{
    $sql = 'SELECT ' . $field . ' FROM ' . $table;
    if (!empty($condition)) {
        $sql .= ' WHERE ' . $condition;
    }

    return getRaw($sql);
}

function first($table, $field = '*', $condition = '')
{
    $sql = 'SELECT ' . $field . ' FROM ' . $table;
    if (!empty($condition)) {
        $sql .= ' WHERE ' . $condition;
    }

    return firstRaw($sql);
}
