<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengunjung</title>

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

        .btn-back {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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

        .avatar {
            width: 80px;
            height: 80px;
            background-color: #444;
            color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 36px;
            font-weight: bold;
            margin: 0 auto 20px;
        }

        .form-group {
            display: grid;
            grid-template-columns: 120px 1fr;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input {
            padding: 8px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .form-group input[readonly] {
            background-color: #f1f1f1;
        }

        .btn-edit {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #1f7a1f;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
        }

        .btn-edit:hover {
            background-color: #166016;
        }
    </style>
</head>
<body>
   @php
    $user = auth()->user();
   @endphp


    <!-- Header -->
    <div class="header">
        <a href="{{ url('/') }}" class="btn-back">← Kembali</a>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="profile-card">

            <!-- Avatar dari huruf pertama nama -->
           <div class="avatar">
    {{ strtoupper(substr($user->username, 0, 1)) }}
</div>

<div class="form-group">
    <label>Username</label>
    <input type="text" value="{{ $user->username }}" readonly>
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" value="{{ $user->email }}" readonly>
</div>

<div class="form-group">
    <label>Nomor Telepon</label>
    <input type="text" value="{{ $user->nomor_telp }}" readonly>
</div>

<div class="form-group">
    <label>Password</label>
    <input type="password" value="********" readonly>
</div>


        <a href="{{ route('edit_profil') }}" class="btn-edit">
    Edit Profil ✏️
</a>

        </div>
    </div>

</body>
</html>
