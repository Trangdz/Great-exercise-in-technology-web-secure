<?php
// if (!defined('_INCODE') || _INCODE != 1) {
//     die('Access denied');
// }

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isLogin()) { 
    // Nếu chưa đăng nhập, hiển thị hình ảnh
    echo '<img src="https://th.bing.com/th/id/OIP.tIwi-ODp5YBJqG4CKOt4UQHaEK?w=294&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Logged in">';
} else {
    // Nếu đã đăng nhập, hiển thị form
    echo '<form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We\'ll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>';
}
?>
