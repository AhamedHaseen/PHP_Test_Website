<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Get user information from session
$user_firstname = $_SESSION['user_firstname'] ?? 'User';
$user_lastname = $_SESSION['user_lastname'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .dashboard-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            margin: 2rem auto;
            max-width: 800px;
        }
        
        .welcome-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .welcome-header h1 {
            color: #333;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }
        
        .welcome-header p {
            color: #666;
            font-size: 1.2rem;
        }
        
        .user-info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
        }
        
        .user-info-card h3 {
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .user-info-card p {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .btn-logout {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-action {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(40, 167, 69, 0.3);
            color: white;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card i {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        .stat-card h4 {
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .stat-card p {
            color: #666;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="dashboard-container">
                <div class="welcome-header">
                    <h1><i class="fas fa-home"></i> Welcome to Your Dashboard</h1>
                    <p>You have successfully logged in to your account</p>
                </div>
                
                <div class="user-info-card">
                    <h3><i class="fas fa-user-circle"></i> User Information</h3>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user_firstname . ' ' . $user_lastname); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
                    <p><strong>Login Time:</strong> <?php echo date('F j, Y, g:i a'); ?></p>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-user-check"></i>
                        <h4>Account Status</h4>
                        <p>Active</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-calendar-alt"></i>
                        <h4>Member Since</h4>
                        <p>Today</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-shield-alt"></i>
                        <h4>Security</h4>
                        <p>Protected</p>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="registration.php" class="btn-action">
                        <i class="fas fa-user-plus"></i> Add New User
                    </a>
                    <button class="btn-logout" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function logout() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out of your account.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, logout!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'logout.php';
        }
    });
}
</script>
</body>
</html>
