<form method="POST" action="/register">
    <div>
        <label>
            <input type="text" name="username" placeholder="Nhập username..."/>
            @csrf
        </label>
    <button type="submit">Đăng ký</button>

    </div>
</form>
