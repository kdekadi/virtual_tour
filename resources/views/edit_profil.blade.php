<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #eef7ea;
        }

        .header {
            background-color: #ffffff;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
        }

        .container {
            display: flex;
            justify-content: center;
            margin-top: 60px;
        }


        .profile-card {
            background-color: #ffffff;
            width: 420px;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #bbb;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .form-group {
            display: grid;
            grid-template-columns: 130px 1fr;
            margin-bottom: 15px;
            align-items: center;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .btn-save {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            background-color: #1f7a1f;
            color: #fff;
            border-radius: 5px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-save:hover {
            background-color: #166016;
        }
        .btn-back {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>

<div class="header">
    <a href="{{ route('profil') }}" class="btn-back">← Kembali</a>
</div>

<div class="container">
    <div class="profile-card">

        <h3>Edit Profil</h3>

        <form action="{{ route('profil.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="nomor_telp" value="{{ old('nomor_telp', $user->nomor_telp) }}">
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password">
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation">
            </div>

            <button class="btn-save">Simpan Perubahan</button>

        </form>

    </div>
</div>

</body>
</html>
