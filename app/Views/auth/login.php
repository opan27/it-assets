<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - IT Maintenance</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white p-8 rounded shadow-md w-96">
    <h1 class="text-xl font-bold mb-4 text-center">Login Admin</h1>
    <?php if(session()->getFlashdata('error')): ?>
      <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <form action="/login" method="post" class="space-y-4">
      <input type="text" name="username" placeholder="Username" class="w-full border px-3 py-2 rounded">
      <input type="password" name="password" placeholder="Password" class="w-full border px-3 py-2 rounded">
      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Login</button>
    </form>
  </div>
</body>
</html>
