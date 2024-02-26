<div class="flex items-center justify-center min-w-full">
    <div class="max-w-md w-full mx-auto bg-gradient-to-br from-blue-500 to-purple-600 bg-opacity-90 backdrop-filter backdrop-blur-lg rounded-lg shadow-lg p-8">
        <form action="/api/auth/login.php" method="POST" class="space-y-6">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-100"><?php echo $translations['username']; ?></label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-100"><?php echo $translations['password']; ?></label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-gray-100 hover:from-indigo-600 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <?php echo $translations['login']; ?>
                </button>
            </div>
        </form>
    </div>
</div>