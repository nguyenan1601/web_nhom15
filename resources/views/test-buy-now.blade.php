<!DOCTYPE html>
<html>
<head>
    <title>Test Mua Ngay</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .form-group { margin: 20px 0; }
        button { padding: 10px 20px; margin: 10px; }
        .btn-primary { background: #007bff; color: white; border: none; }
        .btn-success { background: #28a745; color: white; border: none; }
    </style>
</head>
<body>
    <h1>Test Form Mua Ngay</h1>
    
    <form action="{{ route('cart.add', 1) }}" method="POST" id="testForm">
        @csrf
        
        <div class="form-group">
            <label>Màu sắc:</label><br>
            <input type="radio" name="color" value="Trắng" id="white" checked>
            <label for="white">Trắng</label><br>
            <input type="radio" name="color" value="Đen" id="black">
            <label for="black">Đen</label><br>
            <input type="radio" name="color" value="Vàng" id="yellow">
            <label for="yellow">Vàng</label>
        </div>
        
        <div class="form-group">
            <label for="quantity">Số lượng:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn-primary">Thêm vào giỏ hàng</button>
            <button type="submit" name="buy_now" value="1" class="btn-success">Mua ngay</button>
        </div>
    </form>
    
    <div id="results"></div>
    
    <script>
        document.getElementById('testForm').addEventListener('submit', function(e) {
            console.log('Form submitted');
            console.log('Submitter:', e.submitter);
            console.log('Form data:', new FormData(this));
        });
    </script>
</body>
</html>
