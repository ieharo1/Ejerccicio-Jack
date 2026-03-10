<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taller Mecánico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .login-header {
            background: #2c3e50;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .login-body {
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <div class="login-header">
                        <h3><i class="bi bi-car-mechanic"></i> Taller Mecánico</h3>
                        <p class="mb-0">Sistema de Gestión</p>
                    </div>
                    <div class="login-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" required autofocus>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
